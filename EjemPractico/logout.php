<?php
// VULNERABILIDAD: Exposición de errores en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// VULNERABILIDAD: Logout inseguro - información sensible en logs
session_start();

$user = $_SESSION['user'] ?? 'guest';
$session_id = session_id();
$logout_time = date('Y-m-d H:i:s');
$user_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// VULNERABILIDAD: Logging de información sensible
error_log("User logout: $user (Session: $session_id) from IP: $user_ip at $logout_time");

// VULNERABILIDAD: Destrucción incompleta de sesión
$_SESSION = [];
session_destroy();

// VULNERABILIDAD: No invalidar cookies de sesión adecuadamente
// En un sistema seguro, se deberían invalidar todas las cookies relacionadas
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión - Sistema Empresarial</title>
    <!-- VULNERABILIDAD: Falta de headers de seguridad -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .logout-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .logout-header {
            margin-bottom: 30px;
        }
        .logout-header h2 {
            color: #27ae60;
            margin-bottom: 10px;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #ffeaa7;
            font-size: 14px;
        }
        .nav-links {
            margin-top: 30px;
        }
        .nav-links a {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            margin: 0 10px;
            transition: background 0.3s ease;
            font-weight: bold;
        }
        .nav-links a:hover {
            background: #229954;
        }
        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-family: monospace;
            font-size: 12px;
            color: #6c757d;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-header">
            <h2>🚪 Sesión Cerrada</h2>
            <p>Has cerrado sesión exitosamente</p>
        </div>

        <div class="success-message">
            <strong>✅ Logout Exitoso</strong><br>
            Usuario: <?php echo htmlspecialchars($user); ?><br>
            Hora: <?php echo $logout_time; ?><br>
            IP: <?php echo htmlspecialchars($user_ip); ?>
        </div>

        <div class="warning">
            <strong>⚠️ VULNERABILIDAD DETECTADA:</strong><br>
            El proceso de logout tiene vulnerabilidades de seguridad:
            <ul style="text-align: left; margin: 10px 0;">
                <li>Información sensible registrada en logs</li>
                <li>Destrucción incompleta de sesión</li>
                <li>Cookies no invalidadas adecuadamente</li>
                <li>Falta de redirección automática</li>
            </ul>
        </div>

        <!-- VULNERABILIDAD: Información de debug expuesta -->
        <div class="debug-info">
            <strong>🐛 Debug Info (VULNERABILIDAD):</strong><br>
            Session ID anterior: <?php echo $session_id; ?><br>
            Tiempo de logout: <?php echo $logout_time; ?><br>
            User Agent: <?php echo $_SERVER['HTTP_USER_AGENT'] ?? 'N/A'; ?><br>
            Referer: <?php echo $_SERVER['HTTP_REFERER'] ?? 'N/A'; ?><br>
            Server: <?php echo $_SERVER['SERVER_NAME']; ?><br>
            Script: <?php echo $_SERVER['SCRIPT_NAME']; ?><br>
        </div>

        <div class="nav-links">
            <a href="index.php">🏠 Inicio</a>
            <a href="login.php">🔐 Iniciar Sesión</a>
            <a href="admin.php">👨‍💼 Admin</a>
            <a href="config.php">⚙️ Config</a>
        </div>
    </div>

    <script>
        // VULNERABILIDAD: Información sensible en JavaScript
        console.log('=== LOGOUT DEBUG INFO ===');
        console.log('Logout Details:', {
            'user': '<?php echo $user; ?>',
            'session_id': '<?php echo $session_id; ?>',
            'logout_time': '<?php echo $logout_time; ?>',
            'user_ip': '<?php echo $user_ip; ?>',
            'user_agent': '<?php echo $_SERVER['HTTP_USER_AGENT'] ?? 'N/A'; ?>'
        });
        
        // Mostrar vulnerabilidades
        document.addEventListener('DOMContentLoaded', function() {
            console.warn('⚠️ VULNERABILIDADES EN LOGOUT:');
            console.warn('1. Información sensible en logs del servidor');
            console.warn('2. Session ID expuesto en debug');
            console.warn('3. Destrucción incompleta de sesión');
            console.warn('4. Falta de invalidación de cookies');
            console.warn('5. Información de usuario en JavaScript');
            
            // Simular redirección automática después de 10 segundos
            setTimeout(function() {
                console.log('Redirigiendo a la página de inicio...');
                // window.location.href = 'index.php';
            }, 10000);
        });
        
        // VULNERABILIDAD: Intentar acceder a datos de sesión después del logout
        fetch('admin.php')
            .then(response => response.text())
            .then(data => {
                console.log('Verificando acceso post-logout a admin.php...');
                if (data.includes('Panel de Administración')) {
                    console.error('🚨 VULNERABILIDAD: Acceso a admin.php aún posible después del logout');
                }
            })
            .catch(error => {
                console.log('Error verificando acceso:', error);
            });
    </script>
</body>
</html>