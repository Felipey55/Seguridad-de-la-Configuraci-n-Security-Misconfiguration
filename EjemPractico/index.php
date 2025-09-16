<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Empresarial - Demo</title>
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
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .nav {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .nav a {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .nav a:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .warning {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        .vulnerability-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 5px solid #e74c3c;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            margin: 5px;
        }
        .btn-primary {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
        }
        .btn-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏢 Sistema de Gestión Empresarial</h1>
            <p>Plataforma Integral de Administración</p>
        </div>

        <div class="warning">
            <h3>⚠️ APLICACIÓN DE DEMOSTRACIÓN EDUCATIVA</h3>
            <p>Esta aplicación contiene vulnerabilidades de configuración intencionalmente para fines educativos.</p>
        </div>

        <nav class="nav">
            <a href="login.php">🔐 Iniciar Sesión</a>
            <a href="admin.php">👨‍💼 Panel Admin</a>
            <a href="upload.php">📁 Subir Archivos</a>
            <a href="config.php">⚙️ Configuración</a>
            <a href="info.php">ℹ️ Información del Sistema</a>
            <a href="debug.php">🐛 Debug</a>
        </nav>

        <div class="features">
            <div class="feature-card">
                <h3>🔐 Gestión de Usuarios</h3>
                <p>Sistema de autenticación y autorización de usuarios con diferentes niveles de acceso.</p>
                <a href="login.php" class="btn btn-primary">Acceder</a>
            </div>

            <div class="feature-card">
                <h3>📊 Panel de Control</h3>
                <p>Dashboard administrativo con métricas y configuraciones del sistema.</p>
                <a href="admin.php" class="btn btn-primary">Ver Panel</a>
            </div>

            <div class="feature-card">
                <h3>📁 Gestión de Archivos</h3>
                <p>Sistema de carga y gestión de documentos empresariales.</p>
                <a href="upload.php" class="btn btn-primary">Subir Archivos</a>
            </div>

            <div class="feature-card">
                <h3>⚙️ Configuración</h3>
                <p>Ajustes y configuraciones del sistema empresarial.</p>
                <a href="config.php" class="btn btn-primary">Configurar</a>
            </div>
        </div>

        <div class="vulnerability-info">
            <h2>🎯 Vulnerabilidades de Security Misconfiguration Demostradas</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; margin-top: 20px;">
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <strong>1. Exposición de Información de Debug</strong><br>
                    <small>Errores y información técnica visible al usuario</small>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <strong>2. Configuraciones por Defecto</strong><br>
                    <small>Credenciales y configuraciones sin cambiar</small>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <strong>3. Headers de Seguridad Ausentes</strong><br>
                    <small>Falta de headers protectivos HTTP</small>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <strong>4. Archivos de Configuración Expuestos</strong><br>
                    <small>Acceso a archivos sensibles del sistema</small>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <strong>5. Directorios sin Protección</strong><br>
                    <small>Listado de directorios habilitado</small>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #e74c3c;">
                    <strong>6. Información del Servidor Expuesta</strong><br>
                    <small>Versiones y detalles técnicos visibles</small>
                </div>
            </div>
        </div>

        <div style="text-align: center; background: rgba(255, 255, 255, 0.95); border-radius: 15px; padding: 20px;">
            <h3>📚 Recursos Educativos</h3>
            <a href="../index.html" class="btn btn-primary">🏠 Volver a la Presentación</a>
            <a href="../Practico/index.php" class="btn btn-primary">🔧 Ver Ejemplos de Código</a>
            <a href="vulnerabilities.php" class="btn btn-danger">🎯 Guía de Vulnerabilidades</a>
        </div>
    </div>

    <script>
        console.log('🏢 Sistema de Gestión Empresarial - Demo Cargado');
        console.log('⚠️ Aplicación con vulnerabilidades intencionalmente para fines educativos');
        
        // Información expuesta en consola (vulnerabilidad)
        console.log('Database Config: localhost:3306/empresa_db');
        console.log('Admin User: admin/admin123');
        console.log('Debug Mode: ENABLED');
    </script>
</body>
</html>