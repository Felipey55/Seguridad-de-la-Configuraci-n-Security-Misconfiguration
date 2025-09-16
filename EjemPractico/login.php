<?php
// VULNERABILIDAD: Inclusión de archivos sensibles
require_once 'sample_data.php';
require_once 'db_connection.php';

session_start();

$error_message = '';
$success_message = '';

// VULNERABILIDAD: Procesamiento de login sin protección CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // VULNERABILIDAD: Logging de credenciales en texto plano
    error_log("Login attempt: username=$username, password=$password");
    
    if (empty($username) || empty($password)) {
        $error_message = 'Por favor, completa todos los campos';
    } else {
        // Intentar autenticación con sample_data.php
        $auth_result = authenticateUser($username, $password);
        
        if ($auth_result) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $auth_result['role'];
            $_SESSION['user_id'] = $auth_result['id'];
            
            // VULNERABILIDAD: Logging de información sensible
            error_log("Successful login: user=$username, role={$auth_result['role']}, session_id=" . session_id());
            
            $success_message = "¡Bienvenido, $username! Redirigiendo...";
            
            // Redirección después de login exitoso
            header('Location: admin.php');
            exit;
        } else {
            // VULNERABILIDAD: Mensaje de error detallado
            $error_message = "Error de autenticación: Usuario '$username' no encontrado o contraseña incorrecta. Verifica las credenciales en la base de datos.";
            
            // VULNERABILIDAD: Logging de intentos fallidos con información sensible
            error_log("Failed login attempt: username=$username, password=$password, IP={$_SERVER['REMOTE_ADDR']}");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Empresarial</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            overflow-x: auto;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            min-height: calc(100vh - 40px);
        }

        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        .login-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .info-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            height: fit-content;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .info-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-card h3 {
            color: #495057;
            margin-bottom: 15px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .vulnerability-list {
            list-style: none;
            padding: 0;
        }

        .vulnerability-list li {
            background: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .vulnerability-list strong {
            color: #dc3545;
        }

        .credentials-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .credentials-table th,
        .credentials-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .credentials-table th {
            background: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }

        .credentials-table .password {
            color: #dc3545;
            font-weight: bold;
            font-family: monospace;
        }

        .credentials-table .active {
            background: #d4edda;
        }

        .credentials-table .inactive {
            background: #f8d7da;
        }

        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
            color: #6c757d;
            word-break: break-all;
        }

        .nav-links {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        .nav-links a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: rgba(52, 152, 219, 0.1);
            text-decoration: none;
        }

        .section-title {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            margin: -30px -30px 20px -30px;
            border-radius: 15px 15px 0 0;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .collapsible {
            background-color: #f1f1f1;
            color: #444;
            cursor: pointer;
            padding: 15px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .collapsible:hover {
            background-color: #ddd;
        }

        .collapsible-content {
            display: none;
            padding: 0 15px 15px 15px;
            background-color: #f9f9f9;
            border-radius: 0 0 8px 8px;
            margin-bottom: 15px;
        }

        .collapsible-content.active {
            display: block;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .login-section,
            .info-section {
                padding: 20px;
            }
            
            .section-title {
                margin: -20px -20px 15px -20px;
                padding: 12px 15px;
                font-size: 1rem;
            }
            
            .credentials-table {
                font-size: 0.8rem;
            }
            
            .credentials-table th,
            .credentials-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sección de Login -->
        <div class="login-section">
            <div class="section-title">🔐 Panel de Acceso</div>
            
            <div class="login-header">
                <h2>Iniciar Sesión</h2>
                <p>Sistema de Gestión Empresarial</p>
            </div>

            <!-- Mensajes de estado del login -->
            <?php if ($error_message): ?>
            <div class="alert alert-error">
                <strong>❌ Error:</strong> <?php echo htmlspecialchars($error_message); ?>
            </div>
            <?php endif; ?>
            
            <?php if ($success_message): ?>
            <div class="alert alert-success">
                <strong>✅ Éxito:</strong> <?php echo htmlspecialchars($success_message); ?>
            </div>
            <?php endif; ?>
            
            <!-- Credenciales de Demostración -->
            <div class="alert alert-warning">
                <strong>⚠️ Credenciales de Demostración:</strong><br>
                <small>
                    • admin / admin123 (Administrador)<br>
                    • user / user123 (Usuario)<br>
                    • guest / guest (Invitado)<br>
                    • developer / dev2024! (Desarrollador)
                </small>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required 
                           placeholder="Ingresa tu usuario">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required
                           placeholder="Ingresa tu contraseña">
                </div>

                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>

            <div class="nav-links">
                <a href="#" onclick="showPage('home')">🏠 Inicio</a>
                <a href="#" onclick="showPage('admin')">👨‍💼 Admin</a>
                <a href="#" onclick="showPage('config')">⚙️ Config</a>
                <a href="#" onclick="showPage('info')">ℹ️ Info</a>
            </div>
        </div>

        <!-- Sección de Información -->
        <div class="info-section">
            <div class="section-title">📋 Información de Seguridad</div>

            <!-- Vulnerabilidades -->
            <div class="info-card">
                <h3>⚠️ Vulnerabilidades de Seguridad Detectadas</h3>
                <ul class="vulnerability-list">
                    <li><strong>Credenciales por defecto:</strong> Usuarios con contraseñas débiles</li>
                    <li><strong>Exposición de errores:</strong> Mensajes detallados revelan información sensible</li>
                    <li><strong>Logging inseguro:</strong> Contraseñas registradas en logs del sistema</li>
                    <li><strong>Validación débil:</strong> Sin protección contra ataques de fuerza bruta</li>
                    <li><strong>Headers de seguridad:</strong> Faltan headers de seguridad importantes</li>
                    <li><strong>Información de debug:</strong> Datos sensibles expuestos en consola</li>
                </ul>
            </div>

            <!-- Credenciales Disponibles -->
            <button class="collapsible">🔑 Credenciales Disponibles para Pruebas</button>
            <div class="collapsible-content">
                <div class="alert alert-error">
                    <strong>⚠️ VULNERABILIDAD:</strong> Credenciales expuestas públicamente
                </div>
                <table class="credentials-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="active">
                            <td>admin</td>
                            <td class="password">admin123</td>
                            <td>Administrador</td>
                            <td>✅ Activo</td>
                        </tr>
                        <tr class="active">
                            <td>user</td>
                            <td class="password">user123</td>
                            <td>Usuario</td>
                            <td>✅ Activo</td>
                        </tr>
                        <tr class="active">
                            <td>guest</td>
                            <td class="password">guest</td>
                            <td>Invitado</td>
                            <td>✅ Activo</td>
                        </tr>
                        <tr class="inactive">
                            <td>test</td>
                            <td class="password">123456</td>
                            <td>Tester</td>
                            <td>❌ Inactivo</td>
                        </tr>
                        <tr class="active">
                            <td>developer</td>
                            <td class="password">dev2024!</td>
                            <td>Desarrollador</td>
                            <td>✅ Activo</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Información de Debug -->
            <button class="collapsible">🐛 Información de Debug (VULNERABILIDAD)</button>
            <div class="collapsible-content">
                <div class="debug-info">
                    <strong>Server Info:</strong><br>
                    Server: localhost:8081<br>
                    PHP Version: 8.2.0<br>
                    Document Root: /var/www/html<br>
                    Script Name: /login.php<br>
                    User Agent: Mozilla/5.0...<br>
                    Remote IP: 127.0.0.1<br>
                    Session ID: abcd1234567890<br>
                    Include Path: .:/usr/share/php<br>
                    <br>
                    <strong>Database Connection:</strong><br>
                    mysql://admin:admin123@localhost:3306/empresa_db<br>
                    <br>
                    <strong>Secret Keys:</strong><br>
                    API Key: sk-1234567890abcdef<br>
                    Secret Key: my_super_secret_key_123
                </div>
            </div>

            <!-- Configuración de Sesión -->
            <button class="collapsible">⚙️ Configuración de Sesión</button>
            <div class="collapsible-content">
                <div class="debug-info">
                    Session Name: PHPSESSID<br>
                    Session ID: sess_123456789<br>
                    Session Save Path: /tmp<br>
                    Session Cookie Lifetime: 0<br>
                    Session Cookie Domain: localhost<br>
                    Session Cookie Secure: false<br>
                    Session Cookie HTTPOnly: false
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad para secciones colapsables
        document.querySelectorAll('.collapsible').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                content.classList.toggle('active');
            });
        });

        // Auto-completar para demostración
        document.addEventListener('DOMContentLoaded', function() {
            const usernameField = document.getElementById('username');
            const passwordField = document.getElementById('password');
            
            // Sugerir credenciales por defecto
            usernameField.addEventListener('focus', function() {
                if (!this.value) {
                    this.placeholder = 'Prueba: admin, user, guest, test, demo';
                }
            });

            // VULNERABILIDAD: Validación solo del lado del cliente
            document.querySelector('form').addEventListener('submit', function(e) {
                const username = usernameField.value;
                const password = passwordField.value;
                
                // Solo validación básica del lado del cliente (insegura)
                if (!username || !password) {
                    alert('Por favor, completa todos los campos');
                    e.preventDefault();
                    return false;
                }
                
                // VULNERABILIDAD: Logging de credenciales en consola del navegador
                console.log('Enviando credenciales:', { username: username, password: password });
            });
        });

        // Simulación de navegación
        function showPage(page) {
            alert(`Demo: Navegando a la página de ${page}`);
        }

        // VULNERABILIDAD: Información sensible en JavaScript
        console.log('=== LOGIN DEBUG INFO ===');
        console.log('Default users:', {
            'admin': 'admin123',
            'user': 'user123', 
            'guest': 'guest',
            'test': '123456',
            'developer': 'dev2024!'
        });
        console.log('Database: mysql://admin:admin123@localhost:3306/empresa_db');
        console.log('Session config:', {
            'session_name': 'PHPSESSID',
            'session_id': 'sess_123456789',
            'session_save_path': '/tmp'
        });
    </script>
</body>
</html>