<?php
// VULNERABILIDAD: Exposición de información del sistema
// phpinfo() expone información sensible del servidor

// VULNERABILIDAD: Exposición de errores en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// VULNERABILIDAD: Sin control de acceso
$show_phpinfo = isset($_GET['phpinfo']) && $_GET['phpinfo'] === '1';
$show_server_info = isset($_GET['server']) && $_GET['server'] === '1';
$show_env_vars = isset($_GET['env']) && $_GET['env'] === '1';
$show_loaded_extensions = isset($_GET['ext']) && $_GET['ext'] === '1';

// Función para obtener información del sistema
function getSystemInfo() {
    return [
        'php_version' => PHP_VERSION,
        'php_os' => PHP_OS,
        'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
        'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'N/A',
        'server_name' => $_SERVER['SERVER_NAME'] ?? 'N/A',
        'server_addr' => $_SERVER['SERVER_ADDR'] ?? 'N/A',
        'server_port' => $_SERVER['SERVER_PORT'] ?? 'N/A',
        'script_filename' => $_SERVER['SCRIPT_FILENAME'] ?? 'N/A',
        'request_uri' => $_SERVER['REQUEST_URI'] ?? 'N/A',
        'query_string' => $_SERVER['QUERY_STRING'] ?? 'N/A',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'N/A',
        'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? 'N/A',
        'remote_host' => $_SERVER['REMOTE_HOST'] ?? 'N/A',
        'remote_port' => $_SERVER['REMOTE_PORT'] ?? 'N/A'
    ];
}

// Función para obtener configuraciones críticas de PHP
function getCriticalPHPSettings() {
    return [
        'display_errors' => ini_get('display_errors'),
        'display_startup_errors' => ini_get('display_startup_errors'),
        'log_errors' => ini_get('log_errors'),
        'error_log' => ini_get('error_log'),
        'allow_url_fopen' => ini_get('allow_url_fopen'),
        'allow_url_include' => ini_get('allow_url_include'),
        'enable_dl' => ini_get('enable_dl'),
        'expose_php' => ini_get('expose_php'),
        'file_uploads' => ini_get('file_uploads'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'max_execution_time' => ini_get('max_execution_time'),
        'memory_limit' => ini_get('memory_limit'),
        'session.cookie_secure' => ini_get('session.cookie_secure'),
        'session.cookie_httponly' => ini_get('session.cookie_httponly'),
        'session.use_strict_mode' => ini_get('session.use_strict_mode'),
        'session.cookie_samesite' => ini_get('session.cookie_samesite'),
        'open_basedir' => ini_get('open_basedir'),
        'disable_functions' => ini_get('disable_functions'),
        'disable_classes' => ini_get('disable_classes')
    ];
}

// Función para obtener variables de entorno sensibles
function getSensitiveEnvVars() {
    $sensitive_vars = [];
    $env_vars = ['PATH', 'TEMP', 'TMP', 'USERNAME', 'COMPUTERNAME', 'PROCESSOR_ARCHITECTURE', 
                 'PROCESSOR_IDENTIFIER', 'NUMBER_OF_PROCESSORS', 'OS', 'PATHEXT', 'SYSTEMROOT', 
                 'WINDIR', 'PROGRAMFILES', 'PROGRAMDATA', 'APPDATA', 'LOCALAPPDATA'];
    
    foreach ($env_vars as $var) {
        $value = getenv($var);
        if ($value !== false) {
            $sensitive_vars[$var] = $value;
        }
    }
    
    return $sensitive_vars;
}

$system_info = getSystemInfo();
$php_settings = getCriticalPHPSettings();
$env_vars = getSensitiveEnvVars();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Sistema - Vulnerabilidades de Exposición</title>
    <!-- VULNERABILIDAD: Falta de headers de seguridad -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
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
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .info-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .info-card:hover {
            transform: translateY(-5px);
        }
        .info-card h3 {
            margin-top: 0;
            color: #8e44ad;
            border-bottom: 2px solid #8e44ad;
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
            max-height: 300px;
            overflow-y: auto;
        }
        .nav-links {
            text-align: center;
            margin: 30px 0;
        }
        .nav-links a, .action-btn {
            display: inline-block;
            background: #8e44ad;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            margin: 5px;
            transition: background 0.3s ease;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .nav-links a:hover, .action-btn:hover {
            background: #7d3c98;
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
            word-break: break-all;
        }
        .table th {
            background: #f8f9fa;
            font-weight: bold;
        }
        .phpinfo-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ℹ️ Información del Sistema</h1>
        <p style="color: #8e44ad; font-weight: bold; font-size: 18px;">⚠️ EXPOSICIÓN DE INFORMACIÓN SENSIBLE DEL SERVIDOR ⚠️</p>
    </div>

    <div class="container">
        <div class="warning-banner">
            🚨 VULNERABILIDAD: Este archivo expone información crítica del sistema que puede ser utilizada por atacantes
        </div>

        <!-- Botones de Acción -->
        <div style="text-align: center; margin: 20px 0;">
            <a href="?phpinfo=1" class="action-btn">🐘 Mostrar phpinfo() Completo</a>
            <a href="?server=1" class="action-btn">🖥️ Info del Servidor</a>
            <a href="?env=1" class="action-btn">🌍 Variables de Entorno</a>
            <a href="?ext=1" class="action-btn">🔌 Extensiones Cargadas</a>
            <a href="info.php" class="action-btn">🔄 Limpiar</a>
        </div>

        <?php if ($show_phpinfo): ?>
            <div class="phpinfo-container">
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD CRÍTICA:</strong> phpinfo() expone toda la configuración del servidor
                </div>
                <h3>🐘 Información Completa de PHP</h3>
                <?php 
                // VULNERABILIDAD: Exposición completa de phpinfo()
                phpinfo(); 
                ?>
            </div>
        <?php endif; ?>

        <div class="info-grid">
            <!-- Información del Sistema -->
            <div class="info-card">
                <h3>🖥️ Información del Sistema</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Información del sistema expuesta
                </div>
                <table class="table">
                    <?php foreach ($system_info as $key => $value): ?>
                        <tr>
                            <th><?php echo htmlspecialchars($key); ?></th>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Configuraciones Críticas de PHP -->
            <div class="info-card">
                <h3>🐘 Configuraciones Críticas de PHP</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Configuraciones inseguras expuestas
                </div>
                <table class="table">
                    <?php foreach ($php_settings as $setting => $value): ?>
                        <tr>
                            <th><?php echo htmlspecialchars($setting); ?></th>
                            <td style="color: <?php echo ($value && in_array($setting, ['display_errors', 'allow_url_fopen', 'allow_url_include', 'enable_dl', 'expose_php'])) ? 'red' : 'inherit'; ?>">
                                <?php 
                                if (is_bool($value)) {
                                    echo $value ? 'On' : 'Off';
                                } else {
                                    echo htmlspecialchars($value ?: 'No configurado');
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Extensiones Cargadas -->
            <div class="info-card">
                <h3>🔌 Extensiones de PHP Cargadas</h3>
                <div class="vulnerability-alert">
                    <strong>⚠️ INFORMACIÓN SENSIBLE:</strong> Lista de extensiones puede revelar capacidades del servidor
                </div>
                <div class="code-block">
                    <?php 
                    $extensions = get_loaded_extensions();
                    sort($extensions);
                    foreach ($extensions as $ext) {
                        echo htmlspecialchars($ext) . "\n";
                    }
                    ?>
                </div>
            </div>

            <!-- Variables de Entorno -->
            <div class="info-card">
                <h3>🌍 Variables de Entorno</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Variables de entorno sensibles expuestas
                </div>
                <table class="table">
                    <?php foreach ($env_vars as $var => $value): ?>
                        <tr>
                            <th><?php echo htmlspecialchars($var); ?></th>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Información de Sesión -->
            <div class="info-card">
                <h3>🍪 Información de Sesión</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD:</strong> Detalles de sesión expuestos
                </div>
                <table class="table">
                    <tr><th>Session ID</th><td><?php echo session_id(); ?></td></tr>
                    <tr><th>Session Name</th><td><?php echo session_name(); ?></td></tr>
                    <tr><th>Session Save Path</th><td><?php echo session_save_path(); ?></td></tr>
                    <tr><th>Session Status</th><td><?php echo session_status() === PHP_SESSION_ACTIVE ? 'Activa' : 'Inactiva'; ?></td></tr>
                    <tr><th>Session Module</th><td><?php echo session_module_name(); ?></td></tr>
                </table>
            </div>

            <!-- Información de Memoria y Recursos -->
            <div class="info-card">
                <h3>💾 Uso de Memoria y Recursos</h3>
                <div class="vulnerability-alert">
                    <strong>⚠️ INFORMACIÓN SENSIBLE:</strong> Detalles de recursos del servidor
                </div>
                <table class="table">
                    <tr><th>Memoria Actual</th><td><?php echo number_format(memory_get_usage(true) / 1024 / 1024, 2); ?> MB</td></tr>
                    <tr><th>Memoria Pico</th><td><?php echo number_format(memory_get_peak_usage(true) / 1024 / 1024, 2); ?> MB</td></tr>
                    <tr><th>Límite de Memoria</th><td><?php echo ini_get('memory_limit'); ?></td></tr>
                    <tr><th>Tiempo de Ejecución</th><td><?php echo number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 4); ?> segundos</td></tr>
                    <tr><th>Archivos Incluidos</th><td><?php echo count(get_included_files()); ?></td></tr>
                </table>
            </div>
        </div>

        <?php if ($show_server_info): ?>
            <div class="info-card">
                <h3>🖥️ Información Completa del Servidor</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD CRÍTICA:</strong> Toda la información del servidor expuesta
                </div>
                <div class="code-block">
                    <?php 
                    foreach ($_SERVER as $key => $value) {
                        if (is_string($value)) {
                            echo htmlspecialchars($key) . " = " . htmlspecialchars($value) . "\n";
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($show_env_vars): ?>
            <div class="info-card">
                <h3>🌍 Todas las Variables de Entorno</h3>
                <div class="vulnerability-alert">
                    <strong>❌ VULNERABILIDAD CRÍTICA:</strong> Todas las variables de entorno expuestas
                </div>
                <div class="code-block">
                    <?php 
                    foreach ($_ENV as $key => $value) {
                        echo htmlspecialchars($key) . " = " . htmlspecialchars($value) . "\n";
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($show_loaded_extensions): ?>
            <div class="info-card">
                <h3>🔌 Detalles de Extensiones</h3>
                <div class="vulnerability-alert">
                    <strong>⚠️ INFORMACIÓN SENSIBLE:</strong> Detalles completos de extensiones
                </div>
                <div class="code-block">
                    <?php 
                    foreach (get_loaded_extensions() as $ext) {
                        echo "=== " . strtoupper($ext) . " ===\n";
                        $functions = get_extension_funcs($ext);
                        if ($functions) {
                            echo "Funciones disponibles: " . count($functions) . "\n";
                            echo implode(", ", array_slice($functions, 0, 10));
                            if (count($functions) > 10) {
                                echo "... y " . (count($functions) - 10) . " más";
                            }
                        } else {
                            echo "Sin funciones públicas";
                        }
                        echo "\n\n";
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="nav-links">
            <a href="index.php">🏠 Inicio</a>
            <a href="login.php">🔐 Login</a>
            <a href="admin.php">👨‍💼 Admin</a>
            <a href="config.php">⚙️ Config</a>
        </div>
    </div>

    <script>
        // VULNERABILIDAD: Información del sistema en JavaScript
        console.log('=== INFORMACIÓN DEL SISTEMA ===');
        console.log('System Info:', <?php echo json_encode($system_info); ?>);
        console.log('PHP Settings:', <?php echo json_encode($php_settings); ?>);
        console.log('Environment Variables:', <?php echo json_encode($env_vars); ?>);
        console.log('Loaded Extensions:', <?php echo json_encode(get_loaded_extensions()); ?>);
        console.log('Session Info:', {
            'id': '<?php echo session_id(); ?>',
            'name': '<?php echo session_name(); ?>',
            'save_path': '<?php echo session_save_path(); ?>',
            'module': '<?php echo session_module_name(); ?>'
        });
        
        // Información de memoria
        console.log('Memory Usage:', {
            'current': '<?php echo number_format(memory_get_usage(true) / 1024 / 1024, 2); ?> MB',
            'peak': '<?php echo number_format(memory_get_peak_usage(true) / 1024 / 1024, 2); ?> MB',
            'limit': '<?php echo ini_get('memory_limit'); ?>'
        });
        
        // Alertas de seguridad
        document.addEventListener('DOMContentLoaded', function() {
            console.error('🚨 VULNERABILIDADES DE EXPOSICIÓN DE INFORMACIÓN:');
            console.error('1. phpinfo() accesible públicamente');
            console.error('2. Información del sistema expuesta');
            console.error('3. Variables de entorno sensibles');
            console.error('4. Configuraciones de PHP reveladas');
            console.error('5. Detalles de sesión expuestos');
            console.error('6. Información de memoria y recursos');
            console.error('7. Lista completa de extensiones');
        });
    </script>
</body>
</html>