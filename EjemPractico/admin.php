<?php
// VULNERABILIDAD: Exposición de errores en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// VULNERABILIDAD: Inclusión de archivos sensibles
require_once 'sample_data.php';
require_once 'db_connection.php';

// VULNERABILIDAD: Falta de validación de autenticación adecuada
session_start();

// VULNERABILIDAD: Credenciales hardcodeadas
$admin_user = 'admin';
$admin_pass = 'admin123'; // Contraseña por defecto débil

// VULNERABILIDAD: Validación insuficiente
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Permitir acceso sin autenticación adecuada
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = 'guest';
    $_SESSION['role'] = 'admin'; // VULNERABILIDAD: Escalación de privilegios
}

// VULNERABILIDAD: Validación débil de autenticación
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
$user = $_SESSION['user'] ?? 'guest';
$role = $_SESSION['role'] ?? 'user';

// VULNERABILIDAD: Información sensible hardcodeada
$database_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => 'Felipe883344@@',
    'database' => 'empresa_db',
    'port' => 3306
];

$api_keys = [
    'stripe' => 'sk_live_1234567890abcdef',
    'paypal' => 'AQkquBDf1zctJOWGKWUEtKXm6qVhueUEMvXO_-MCI4DQQ4-LWvkDLIN2fGsd',
    'aws' => 'AKIAIOSFODNN7EXAMPLE',
    'google' => 'AIzaSyDaGmWKa4JsXZ-HjGw7ISLn_3namBGewQe'
];

// VULNERABILIDAD: Configuración insegura
$security_config = [
    'ssl_verify' => false,
    'allow_url_fopen' => true,
    'allow_url_include' => true,
    'enable_dl' => true,
    'expose_php' => true,
    'session_cookie_secure' => false,
    'session_cookie_httponly' => false
];

// VULNERABILIDAD: Directorio de uploads sin restricciones
$upload_config = [
    'upload_dir' => 'uploads/',
    'allowed_extensions' => ['*'], // Permite cualquier extensión
    'max_file_size' => '100MB',
    'check_mime_type' => false
];

// Simular datos de la empresa
$company_data = [
    'employees' => [
        ['id' => 1, 'name' => 'Juan Pérez', 'email' => 'juan@empresa.com', 'salary' => 50000, 'ssn' => '123-45-6789'],
        ['id' => 2, 'name' => 'María García', 'email' => 'maria@empresa.com', 'salary' => 60000, 'ssn' => '987-65-4321'],
        ['id' => 3, 'name' => 'Carlos López', 'email' => 'carlos@empresa.com', 'salary' => 55000, 'ssn' => '456-78-9123']
    ],
    'financial' => [
        'bank_account' => '1234567890',
        'routing_number' => '021000021',
        'credit_cards' => ['4532-1234-5678-9012', '5555-4444-3333-2222']
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sistema Empresarial</title>
    <!-- VULNERABILIDAD: Falta de headers de seguridad -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .header {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .info {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .code-block {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            overflow-x: auto;
            margin: 10px 0;
        }
        .nav-links {
            text-align: center;
            margin: 20px 0;
        }
        .nav-links a {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin: 0 10px;
            transition: background 0.3s ease;
        }
        .nav-links a:hover {
            background: #2980b9;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background: #f8f9fa;
            font-weight: bold;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        .status.logged-in {
            background: #d4edda;
            color: #155724;
        }
        .status.guest {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏢 Panel de Administración</h1>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span class="status <?php echo $is_logged_in ? 'logged-in' : 'guest'; ?>">
                    <?php echo $is_logged_in ? "✅ Conectado como: $user ($role)" : "⚠️ Acceso como invitado"; ?>
                </span>
            </div>
            <div>
                <small>Servidor: <?php echo $_SERVER['SERVER_NAME']; ?> | IP: <?php echo $_SERVER['REMOTE_ADDR'] ?? 'N/A'; ?></small>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- VULNERABILIDAD: Acceso sin autenticación adecuada -->
        <?php if (!$is_logged_in): ?>
            <div class="warning">
                <strong>⚠️ VULNERABILIDAD DETECTADA:</strong><br>
                Estás accediendo al panel de administración sin autenticación adecuada. 
                En un sistema real, esto sería una vulnerabilidad crítica de seguridad.
                <br><br>
                <a href="login.php" style="color: #856404; font-weight: bold;">Ir a Login →</a>
            </div>
        <?php endif; ?>

        <div class="dashboard-grid">
            <!-- Configuración de Base de Datos -->
            <div class="card">
                <h3>🗄️ Configuración de Base de Datos</h3>
                <div class="danger">
                    <strong>❌ VULNERABILIDAD: Credenciales Expuestas</strong>
                </div>
                <div class="code-block">
                    Host: <?php echo $database_config['host']; ?><br>
                    Usuario: <?php echo $database_config['username']; ?><br>
                    Contraseña: <?php echo $database_config['password']; ?><br>
                    Base de Datos: <?php echo $database_config['database']; ?><br>
                    Puerto: <?php echo $database_config['port']; ?>
                </div>
            </div>

            <!-- API Keys -->
            <div class="card">
                <h3>🔑 Claves API</h3>
                <div class="danger">
                    <strong>❌ VULNERABILIDAD: API Keys Expuestas</strong>
                </div>
                <div class="code-block">
                    <?php foreach ($api_keys as $service => $key): ?>
                        <?php echo strtoupper($service); ?>: <?php echo $key; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Configuración de Seguridad -->
            <div class="card">
                <h3>🔒 Configuración de Seguridad</h3>
                <div class="danger">
                    <strong>❌ VULNERABILIDAD: Configuración Insegura</strong>
                </div>
                <div class="code-block">
                    <?php foreach ($security_config as $setting => $value): ?>
                        <?php echo $setting; ?>: <?php echo $value ? 'true' : 'false'; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Configuración de Uploads -->
            <div class="card">
                <h3>📁 Configuración de Uploads</h3>
                <div class="danger">
                    <strong>❌ VULNERABILIDAD: Uploads Sin Restricciones</strong>
                </div>
                <div class="code-block">
                    Directorio: <?php echo $upload_config['upload_dir']; ?><br>
                    Extensiones: <?php echo implode(', ', $upload_config['allowed_extensions']); ?><br>
                    Tamaño máximo: <?php echo $upload_config['max_file_size']; ?><br>
                    Verificar MIME: <?php echo $upload_config['check_mime_type'] ? 'Sí' : 'No'; ?>
                </div>
            </div>

            <!-- Información del Sistema -->
            <div class="card">
                <h3>💻 Información del Sistema</h3>
                <div class="warning">
                    <strong>⚠️ VULNERABILIDAD: Información Sensible Expuesta</strong>
                </div>
                <div class="code-block">
                    PHP Version: <?php echo PHP_VERSION; ?><br>
                    OS: <?php echo PHP_OS; ?><br>
                    Server Software: <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?><br>
                    Document Root: <?php echo $_SERVER['DOCUMENT_ROOT']; ?><br>
                    Include Path: <?php echo get_include_path(); ?><br>
                    Memory Limit: <?php echo ini_get('memory_limit'); ?><br>
                    Max Execution Time: <?php echo ini_get('max_execution_time'); ?><br>
                    Upload Max Filesize: <?php echo ini_get('upload_max_filesize'); ?>
                </div>
            </div>

            <!-- Variables de Entorno -->
            <div class="card">
                <h3>🌍 Variables de Entorno</h3>
                <div class="danger">
                    <strong>❌ VULNERABILIDAD: Variables Sensibles Expuestas</strong>
                </div>
                <div class="code-block">
                    <?php
                    $env_vars = ['PATH', 'TEMP', 'TMP', 'USERNAME', 'COMPUTERNAME', 'PROCESSOR_ARCHITECTURE'];
                    foreach ($env_vars as $var) {
                        $value = getenv($var);
                        if ($value) {
                            echo "$var: $value<br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Datos de Empleados -->
        <div class="card">
            <h3>👥 Datos de Empleados</h3>
            <div class="danger">
                <strong>❌ VULNERABILIDAD: Datos Sensibles Sin Protección</strong>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Salario</th>
                        <th>SSN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($company_data['employees'] as $employee): ?>
                        <tr>
                            <td><?php echo $employee['id']; ?></td>
                            <td><?php echo $employee['name']; ?></td>
                            <td><?php echo $employee['email']; ?></td>
                            <td>$<?php echo number_format($employee['salary']); ?></td>
                            <td><?php echo $employee['ssn']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Información Financiera -->
        <div class="card">
            <h3>💳 Información Financiera</h3>
            <div class="danger">
                <strong>❌ VULNERABILIDAD: Datos Financieros Expuestos</strong>
            </div>
            <div class="code-block">
                Cuenta Bancaria: <?php echo $company_data['financial']['bank_account']; ?><br>
                Routing Number: <?php echo $company_data['financial']['routing_number']; ?><br>
                Tarjetas de Crédito:<br>
                <?php foreach ($company_data['financial']['credit_cards'] as $card): ?>
                    - <?php echo $card; ?><br>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div class="card">
            <h3>👥 Gestión de Usuarios</h3>
            <div class="danger">
                <strong>❌ VULNERABILIDAD: Contraseñas expuestas en texto plano</strong>
            </div>
            <div class="code-block">
                <?php
                // VULNERABILIDAD: Mostrar usuarios con contraseñas
                $users = getUsersWithPasswords();
                foreach ($users as $user) {
                    echo "<div style='margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;'>";
                    echo "<strong>{$user['username']}</strong> - {$user['role']}<br>";
                    echo "Email: {$user['email']}<br>";
                    echo "<span style='color: red;'>Contraseña: {$user['password']}</span><br>"; // VULNERABILIDAD
                    echo "Último login: {$user['last_login']}";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <!-- Datos Financieros Adicionales -->
        <div class="card">
            <h3>💰 Datos Financieros Adicionales</h3>
            <div class="danger">
                <strong>❌ VULNERABILIDAD: Información financiera sensible expuesta</strong>
            </div>
            <div class="code-block">
                <?php
                // VULNERABILIDAD: Mostrar datos financieros completos
                $financial = getFinancialData();
                foreach ($financial as $account) {
                    echo "<div style='margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;'>";
                    echo "<strong>{$account['account_type']}</strong>: {$account['currency']} " . number_format($account['balance'], 2) . "<br>";
                    echo "Número de cuenta: {$account['account_number']}<br>"; // VULNERABILIDAD
                    echo "IBAN: {$account['iban']}<br>";
                    echo "SWIFT: {$account['swift_code']}<br>"; // VULNERABILIDAD
                    echo "Banco: {$account['bank_name']}<br>";
                    echo "Última transacción: {$account['last_transaction']}";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <!-- Información Detallada de Empleados -->
        <div class="card">
            <h3>👨‍💼 Información Detallada de Empleados</h3>
            <div class="danger">
                <strong>❌ VULNERABILIDAD: Datos personales sensibles expuestos (SSN, cuentas bancarias)</strong>
            </div>
            <div class="code-block">
                <?php
                // VULNERABILIDAD: Mostrar empleados con información sensible
                $employees = getEmployeesWithSensitiveData();
                foreach ($employees as $employee) {
                    echo "<div style='margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;'>";
                    echo "<strong>{$employee['first_name']} {$employee['last_name']}</strong> - {$employee['position']}<br>";
                    echo "Email: {$employee['email']}<br>";
                    echo "Teléfono: {$employee['phone']}<br>";
                    echo "<span style='color: red;'>Salario: €" . number_format($employee['salary'], 2) . "</span><br>";
                    echo "<span style='color: red;'>SSN: {$employee['ssn']}</span><br>"; // VULNERABILIDAD
                    echo "<span style='color: red;'>Cuenta bancaria: {$employee['bank_account']}</span><br>"; // VULNERABILIDAD
                    echo "Departamento: {$employee['department']}<br>";
                    echo "Fecha de contratación: {$employee['hire_date']}";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <div class="nav-links">
            <a href="index.php">🏠 Inicio</a>
            <a href="login.php">🔐 Login</a>
            <a href="config.php">⚙️ Configuración</a>
            <a href="info.php">ℹ️ PHP Info</a>
            <a href="logout.php">🚪 Cerrar Sesión</a>
        </div>
    </div>

    <script>
        // VULNERABILIDAD: Información sensible en JavaScript
        console.log('=== ADMIN PANEL DEBUG ===');
        console.log('Database Config:', <?php echo json_encode($database_config); ?>);
        console.log('API Keys:', <?php echo json_encode($api_keys); ?>);
        console.log('Security Config:', <?php echo json_encode($security_config); ?>);
        console.log('Employee Data:', <?php echo json_encode($company_data); ?>);
        console.log('Session Data:', {
            'user': '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>',
            'role': '<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : 'admin'; ?>',
            'session_id': '<?php echo session_id(); ?>'
        });
        
        // Mostrar alertas de vulnerabilidades
        document.addEventListener('DOMContentLoaded', function() {
            console.warn('⚠️ MÚLTIPLES VULNERABILIDADES DETECTADAS:');
            console.warn('1. Credenciales de base de datos expuestas');
            console.warn('2. API Keys visibles en el código');
            console.warn('3. Configuración de seguridad insegura');
            console.warn('4. Datos sensibles sin cifrar');
            console.warn('5. Falta de validación de autenticación');
            console.warn('6. Información del sistema expuesta');
        });
    </script>
</body>
</html>