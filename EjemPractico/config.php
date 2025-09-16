<?php
// VULNERABILIDAD: Archivo de configuración accesible públicamente
// Este archivo debería estar fuera del directorio web público

// VULNERABILIDAD: Exposición de errores en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// VULNERABILIDAD: Inclusión de archivos sensibles
require_once 'sample_data.php';
// require_once 'db_connection.php'; // Comentado para usar solo datos de muestra

// VULNERABILIDAD: Configuraciones inseguras de PHP
ini_set('allow_url_fopen', 1);
ini_set('allow_url_include', 1);
ini_set('enable_dl', 1);
ini_set('expose_php', 1);
ini_set('log_errors_max_len', 0);
ini_set('ignore_repeated_errors', 0);
ini_set('track_errors', 1);

// VULNERABILIDAD: Credenciales hardcodeadas
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'empresa_db');
define('DB_PORT', 3306);

// VULNERABILIDAD: Claves secretas expuestas
define('SECRET_KEY', 'my_super_secret_key_123');
define('JWT_SECRET', 'jwt_secret_key_456');
define('ENCRYPTION_KEY', 'encryption_key_789');
define('API_SECRET', 'api_secret_abc123');

// VULNERABILIDAD: Configuración de sesiones insegura
ini_set('session.cookie_secure', 0);
ini_set('session.cookie_httponly', 0);
ini_set('session.use_strict_mode', 0);
ini_set('session.cookie_samesite', 'None');
ini_set('session.gc_maxlifetime', 86400); // 24 horas

// VULNERABILIDAD: APIs y servicios externos
$external_apis = [
    'stripe' => [
        'public_key' => 'pk_live_1234567890abcdef',
        'secret_key' => 'sk_live_1234567890abcdef',
        'webhook_secret' => 'whsec_1234567890abcdef'
    ],
    'paypal' => [
        'client_id' => 'AQkquBDf1zctJOWGKWUEtKXm6qVhueUEMvXO',
        'client_secret' => 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL'
    ],
    'aws' => [
        'access_key' => 'AKIAIOSFODNN7EXAMPLE',
        'secret_key' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
        'region' => 'us-east-1'
    ],
    'google' => [
        'api_key' => 'AIzaSyDaGmWKa4JsXZ-HjGw7ISLn_3namBGewQe',
        'client_id' => '1234567890-abcdefghijklmnopqrstuvwxyz.apps.googleusercontent.com',
        'client_secret' => 'GOCSPX-1234567890abcdefghijklmnop'
    ]
];

// VULNERABILIDAD: Configuración de email con credenciales
$email_config = [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_user' => 'empresa@gmail.com',
    'smtp_pass' => 'password123',
    'from_email' => 'noreply@empresa.com',
    'from_name' => 'Sistema Empresarial'
];

// VULNERABILIDAD: Configuración de FTP
$ftp_config = [
    'host' => 'ftp.empresa.com',
    'username' => 'ftpuser',
    'password' => 'ftppass123',
    'port' => 21,
    'passive' => true
];

// VULNERABILIDAD: Configuración de backup
$backup_config = [
    'backup_dir' => '/var/backups/',
    'backup_user' => 'backup',
    'backup_pass' => 'backup123',
    'encryption' => false,
    'retention_days' => 30
];

// VULNERABILIDAD: Configuración de logging
$log_config = [
    'log_level' => 'DEBUG',
    'log_file' => '/var/log/app.log',
    'log_sensitive_data' => true,
    'log_passwords' => true,
    'log_api_keys' => true
];

// VULNERABILIDAD: Configuración de uploads insegura
$upload_config = [
    'upload_dir' => 'uploads/',
    'max_file_size' => '100MB',
    'allowed_extensions' => ['*'], // Permite cualquier extensión
    'check_mime_type' => false,
    'allow_php_upload' => true,
    'quarantine_suspicious' => false
];

// VULNERABILIDAD: Configuración de CORS permisiva
$cors_config = [
    'allow_origin' => '*',
    'allow_methods' => 'GET, POST, PUT, DELETE, OPTIONS',
    'allow_headers' => '*',
    'allow_credentials' => true
];

// VULNERABILIDAD: Configuración de rate limiting deshabilitada
$rate_limit_config = [
    'enabled' => false,
    'max_requests' => 1000,
    'time_window' => 3600,
    'block_duration' => 0
];

// VULNERABILIDAD: Usuarios por defecto del sistema
$default_users = [
    'admin' => [
        'password' => 'admin123',
        'role' => 'administrator',
        'email' => 'admin@empresa.com',
        'created' => '2024-01-01'
    ],
    'user' => [
        'password' => 'password',
        'role' => 'user',
        'email' => 'user@empresa.com',
        'created' => '2024-01-01'
    ],
    'guest' => [
        'password' => 'guest',
        'role' => 'guest',
        'email' => 'guest@empresa.com',
        'created' => '2024-01-01'
    ],
    'test' => [
        'password' => 'test123',
        'role' => 'tester',
        'email' => 'test@empresa.com',
        'created' => '2024-01-01'
    ]
];

session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración del Sistema - Vulnerabilidades Expuestas</title>
    <!-- VULNERABILIDAD: Falta de headers de seguridad -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .header {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .config-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .config-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .config-card:hover {
            transform: translateY(-5px);
        }
        .config-card h3 {
            margin-top: 0;
            color: #e74c3c;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 10px;
        }
        .vulnerability-alert {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            color: #721c24;
        }
        .critical {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
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
            white-space: pre-wrap;
        }
        .nav-links {
            text-align: center;
            margin: 30px 0;
        }
        .nav-links a {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            margin: 0 10px;
            transition: background 0.3s ease;
            font-weight: bold;
        }
        .nav-links a:hover {
            background: #c0392b;
        }
        .warning-banner {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #856404;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 12px;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>⚙️ Configuración del Sistema</h1>
        <p style="color: #e74c3c; font-weight: bold; font-size: 18px;">⚠️ ARCHIVO DE CONFIGURACIÓN EXPUESTO PÚBLICAMENTE ⚠️</p>
    </div>

    <div class="container">
        <div class="warning-banner">
            🚨 VULNERABILIDAD CRÍTICA: Este archivo de configuración está accesible públicamente y contiene información sensible
        </div>

        <div class="config-grid">
            <!-- Configuración de Base de Datos -->
            <div class="config-card">
                <h3>🗄️ Configuración de Base de Datos</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD CRÍTICA:</strong> Credenciales de base de datos expuestas
                </div>
                <?php
                // VULNERABILIDAD: Mostrar credenciales de base de datos hardcodeadas
                 $db_credentials = [
                     'host' => 'localhost',
                     'user' => 'root',
                     'password' => 'admin123',
                     'database' => 'empresa_db',
                     'port' => 3306
                 ];
                 foreach ($db_credentials as $key => $value) {
                     echo "<div class='code-block'>";
                     echo "<strong>" . strtoupper($key) . ":</strong> ";
                     if ($key === 'password') {
                         echo "<span style='color: red; font-weight: bold;'>$value</span>"; // VULNERABILIDAD
                     } else {
                         echo "<span style='font-family: monospace;'>$value</span>";
                     }
                     echo "</div>";
                 }
                 
                 // VULNERABILIDAD: Simulación de test de conexión
                 echo "<div style='margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px;'>";
                 echo "<h4>🔍 Test de Conexión a Base de Datos</h4>";
                 echo "<p><strong>✅ Conexión Simulada Exitosa</strong></p>";
                 echo "<p><strong>Host:</strong> localhost</p>";
                 echo "<p><strong>Usuario:</strong> root</p>";
                 echo "<p><strong>Contraseña:</strong> <span style='color: red;'>admin123</span></p>"; // VULNERABILIDAD
                 echo "<p><strong>Base de Datos:</strong> empresa_db</p>";
                 echo "<p><strong>Puerto:</strong> 3306</p>";
                 echo "</div>";
                ?>
            </div>

            <!-- Claves Secretas -->
            <div class="config-card">
                <h3>🔑 Configuraciones Sensibles del Sistema</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD CRÍTICA:</strong> Configuraciones sensibles expuestas públicamente
                </div>
                <?php
                // VULNERABILIDAD: Mostrar todas las configuraciones sensibles
                $sensitive_configs = getSensitiveConfig();
                foreach ($sensitive_configs as $config) {
                    echo "<div class='code-block'>";
                    echo "<strong>{$config['config_key']}:</strong> ";
                    echo "<span style='color: red; font-family: monospace;'>{$config['config_value']}</span>"; // VULNERABILIDAD
                    echo "<br><small style='color: #666;'>{$config['description']}</small>";
                    echo "</div>";
                }
                ?>
            </div>

            <!-- APIs Externas -->
            <div class="config-card">
                <h3>🌐 APIs Externas</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD CRÍTICA:</strong> Claves de APIs de terceros expuestas
                </div>
                <div class="code-block">
<?php foreach ($external_apis as $service => $config): ?>
[<?php echo strtoupper($service); ?>]
<?php foreach ($config as $key => $value): ?>
<?php echo $key; ?> = <?php echo $value; ?>
<?php endforeach; ?>

<?php endforeach; ?>
                </div>
            </div>

            <!-- Configuración de Email -->
            <div class="config-card">
                <h3>📧 Configuración de Email</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Credenciales SMTP expuestas
                </div>
                <div class="code-block">
<?php foreach ($email_config as $key => $value): ?>
<?php echo $key; ?> = <?php echo $value; ?>
<?php endforeach; ?>
                </div>
            </div>

            <!-- Configuración de FTP -->
            <div class="config-card">
                <h3>📁 Configuración de FTP</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Credenciales FTP en texto plano
                </div>
                <div class="code-block">
<?php foreach ($ftp_config as $key => $value): ?>
<?php echo $key; ?> = <?php echo is_bool($value) ? ($value ? 'true' : 'false') : $value; ?>
<?php endforeach; ?>
                </div>
            </div>

            <!-- Configuración de Sesiones -->
            <div class="config-card">
                <h3>🍪 Configuración de Sesiones</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Configuración insegura de sesiones
                </div>
                <div class="code-block">
session.cookie_secure = <?php echo ini_get('session.cookie_secure') ? 'On' : 'Off'; ?>
session.cookie_httponly = <?php echo ini_get('session.cookie_httponly') ? 'On' : 'Off'; ?>
session.use_strict_mode = <?php echo ini_get('session.use_strict_mode') ? 'On' : 'Off'; ?>
session.gc_maxlifetime = <?php echo ini_get('session.gc_maxlifetime'); ?>
                </div>
            </div>

            <!-- Configuración de Uploads -->
            <div class="config-card">
                <h3>📤 Configuración de Uploads</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Uploads sin restricciones de seguridad
                </div>
                <div class="code-block">
<?php foreach ($upload_config as $key => $value): ?>
<?php echo $key; ?> = <?php 
    if (is_array($value)) {
        echo implode(', ', $value);
    } elseif (is_bool($value)) {
        echo $value ? 'true' : 'false';
    } else {
        echo $value;
    }
?>
<?php endforeach; ?>
                </div>
            </div>

            <!-- Configuración de CORS -->
            <div class="config-card">
                <h3>🌍 Configuración de CORS</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> CORS demasiado permisivo
                </div>
                <div class="code-block">
<?php foreach ($cors_config as $key => $value): ?>
<?php echo $key; ?> = <?php echo is_bool($value) ? ($value ? 'true' : 'false') : $value; ?>
<?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Usuarios por Defecto -->
        <div class="config-card">
            <h3>👥 Usuarios por Defecto del Sistema</h3>
            <div class="vulnerability-alert">
                <strong>❌ VULNERABILIDAD CRÍTICA:</strong> Usuarios por defecto con contraseñas débiles
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Email</th>
                        <th>Creado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($default_users as $username => $data): ?>
                        <tr>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $data['password']; ?></td>
                            <td><?php echo $data['role']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['created']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Configuración de PHP -->
        <div class="config-card">
            <h3>🐘 Configuración de PHP</h3>
            <div class="vulnerability-alert">
                <strong>❌ VULNERABILIDAD:</strong> Configuraciones inseguras de PHP
            </div>
            <div class="code-block">
display_errors = <?php echo ini_get('display_errors') ? 'On' : 'Off'; ?>
allow_url_fopen = <?php echo ini_get('allow_url_fopen') ? 'On' : 'Off'; ?>
allow_url_include = <?php echo ini_get('allow_url_include') ? 'On' : 'Off'; ?>
enable_dl = <?php echo ini_get('enable_dl') ? 'On' : 'Off'; ?>
expose_php = <?php echo ini_get('expose_php') ? 'On' : 'Off'; ?>
log_errors_max_len = <?php echo ini_get('log_errors_max_len'); ?>
track_errors = <?php echo ini_get('track_errors') ? 'On' : 'Off'; ?>
            </div>
        </div>

        <div class="nav-links">
            <a href="index.php">🏠 Inicio</a>
            <a href="login.php">🔐 Login</a>
            <a href="admin.php">👨‍💼 Admin</a>
            <a href="info.php">ℹ️ PHP Info</a>
        </div>
    </div>

    <script>
        // VULNERABILIDAD: Toda la configuración expuesta en JavaScript
        console.log('=== CONFIGURACIÓN COMPLETA DEL SISTEMA ===');
        console.log('Database:', <?php echo json_encode([
            'host' => DB_HOST,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'name' => DB_NAME,
            'port' => DB_PORT
        ]); ?>);
        console.log('Secrets:', <?php echo json_encode([
            'secret_key' => SECRET_KEY,
            'jwt_secret' => JWT_SECRET,
            'encryption_key' => ENCRYPTION_KEY,
            'api_secret' => API_SECRET
        ]); ?>);
        console.log('External APIs:', <?php echo json_encode($external_apis); ?>);
        console.log('Email Config:', <?php echo json_encode($email_config); ?>);
        console.log('FTP Config:', <?php echo json_encode($ftp_config); ?>);
        console.log('Default Users:', <?php echo json_encode($default_users); ?>);
        
        // Alertas de seguridad
        document.addEventListener('DOMContentLoaded', function() {
            console.error('🚨 VULNERABILIDADES CRÍTICAS DETECTADAS:');
            console.error('1. Archivo de configuración accesible públicamente');
            console.error('2. Credenciales hardcodeadas en el código');
            console.error('3. Claves secretas expuestas');
            console.error('4. APIs de terceros comprometidas');
            console.error('5. Configuraciones inseguras de PHP');
            console.error('6. Usuarios por defecto con contraseñas débiles');
            console.error('7. Información sensible en JavaScript');
            
            alert('⚠️ ADVERTENCIA: Este archivo contiene múltiples vulnerabilidades de configuración críticas!');
        });
    </script>
</body>
</html>