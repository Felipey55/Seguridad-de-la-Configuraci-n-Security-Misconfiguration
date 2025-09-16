<?php
// VULNERABILIDAD: Archivo de datos sensibles accesible públicamente
// Este archivo contiene datos que simulan una base de datos real

// VULNERABILIDAD: Exposición de errores en producción
ini_set('display_errors', 1);
error_reporting(E_ALL);

// VULNERABILIDAD: Datos de usuarios con contraseñas en texto plano
$users_data = [
    [
        'id' => 1,
        'username' => 'admin',
        'password' => 'admin123', // VULNERABILIDAD: Contraseña por defecto
        'email' => 'admin@empresa.com',
        'role' => 'administrator',
        'last_login' => '2024-01-15 10:30:00',
        'is_active' => true,
        'created_at' => '2023-01-01 00:00:00'
    ],
    [
        'id' => 2,
        'username' => 'user',
        'password' => 'user123', // VULNERABILIDAD: Contraseña débil
        'email' => 'user@empresa.com',
        'role' => 'user',
        'last_login' => '2024-01-14 15:45:00',
        'is_active' => true,
        'created_at' => '2023-02-15 00:00:00'
    ],
    [
        'id' => 3,
        'username' => 'guest',
        'password' => 'guest', // VULNERABILIDAD: Contraseña extremadamente débil
        'email' => 'guest@empresa.com',
        'role' => 'guest',
        'last_login' => '2024-01-10 09:15:00',
        'is_active' => true,
        'created_at' => '2023-03-01 00:00:00'
    ],
    [
        'id' => 4,
        'username' => 'test',
        'password' => '123456', // VULNERABILIDAD: Contraseña común
        'email' => 'test@empresa.com',
        'role' => 'tester',
        'last_login' => null,
        'is_active' => false,
        'created_at' => '2023-12-01 00:00:00'
    ],
    [
        'id' => 5,
        'username' => 'developer',
        'password' => 'dev2024!', // VULNERABILIDAD: Contraseña predecible
        'email' => 'dev@empresa.com',
        'role' => 'developer',
        'last_login' => '2024-01-13 14:20:00',
        'is_active' => true,
        'created_at' => '2023-06-15 00:00:00'
    ]
];

// VULNERABILIDAD: Datos de empleados con información sensible
$employees_data = [
    [
        'id' => 1,
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'email' => 'juan.perez@empresa.com',
        'phone' => '+34 600 123 456',
        'salary' => 45000.00,
        'ssn' => '123-45-6789', // VULNERABILIDAD: Número de seguridad social expuesto
        'bank_account' => 'ES91 2100 0418 4502 0005 1332', // VULNERABILIDAD: Cuenta bancaria expuesta
        'department' => 'IT',
        'position' => 'Senior Developer',
        'hire_date' => '2020-03-15',
        'is_active' => true
    ],
    [
        'id' => 2,
        'first_name' => 'María',
        'last_name' => 'García',
        'email' => 'maria.garcia@empresa.com',
        'phone' => '+34 600 234 567',
        'salary' => 38000.00,
        'ssn' => '234-56-7890',
        'bank_account' => 'ES91 2100 0418 4502 0005 2443',
        'department' => 'HR',
        'position' => 'HR Manager',
        'hire_date' => '2019-07-22',
        'is_active' => true
    ],
    [
        'id' => 3,
        'first_name' => 'Carlos',
        'last_name' => 'López',
        'email' => 'carlos.lopez@empresa.com',
        'phone' => '+34 600 345 678',
        'salary' => 52000.00,
        'ssn' => '345-67-8901',
        'bank_account' => 'ES91 2100 0418 4502 0005 3554',
        'department' => 'Finance',
        'position' => 'Financial Director',
        'hire_date' => '2018-01-10',
        'is_active' => true
    ]
];

// VULNERABILIDAD: Configuraciones del sistema con información sensible
$system_config = [
    [
        'config_key' => 'api_key',
        'config_value' => 'sk-1234567890abcdef1234567890abcdef', // VULNERABILIDAD: API key expuesta
        'is_sensitive' => true,
        'description' => 'API Key para servicios externos'
    ],
    [
        'config_key' => 'database_password',
        'config_value' => 'super_secret_db_pass_2024!', // VULNERABILIDAD: Contraseña de BD
        'is_sensitive' => true,
        'description' => 'Contraseña de la base de datos principal'
    ],
    [
        'config_key' => 'encryption_key',
        'config_value' => 'aes256_key_very_secret_2024_enterprise', // VULNERABILIDAD: Clave de cifrado
        'is_sensitive' => true,
        'description' => 'Clave de cifrado AES-256'
    ],
    [
        'config_key' => 'smtp_password',
        'config_value' => 'email_pass_123!', // VULNERABILIDAD: Contraseña de email
        'is_sensitive' => true,
        'description' => 'Contraseña del servidor SMTP'
    ],
    [
        'config_key' => 'jwt_secret',
        'config_value' => 'jwt_super_secret_key_2024_do_not_share', // VULNERABILIDAD: JWT secret
        'is_sensitive' => true,
        'description' => 'Clave secreta para tokens JWT'
    ],
    [
        'config_key' => 'admin_email',
        'config_value' => 'admin@empresa.com',
        'is_sensitive' => false,
        'description' => 'Email del administrador del sistema'
    ],
    [
        'config_key' => 'app_debug',
        'config_value' => 'true', // VULNERABILIDAD: Debug habilitado en producción
        'is_sensitive' => false,
        'description' => 'Modo debug de la aplicación'
    ]
];

// VULNERABILIDAD: Logs de seguridad con información sensible
$security_logs = [
    [
        'id' => 1,
        'event_type' => 'login_success',
        'username' => 'admin',
        'ip_address' => '192.168.1.100',
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        'details' => 'Successful login with password: admin123', // VULNERABILIDAD: Contraseña en logs
        'created_at' => '2024-01-15 10:30:15'
    ],
    [
        'id' => 2,
        'event_type' => 'login_failed',
        'username' => 'admin',
        'ip_address' => '192.168.1.105',
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        'details' => 'Failed login attempt with password: wrongpass123', // VULNERABILIDAD: Contraseña en logs
        'created_at' => '2024-01-15 09:45:22'
    ],
    [
        'id' => 3,
        'event_type' => 'config_change',
        'username' => 'admin',
        'ip_address' => '192.168.1.100',
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        'details' => 'Changed API key from sk-old123 to sk-1234567890abcdef1234567890abcdef', // VULNERABILIDAD: Claves en logs
        'created_at' => '2024-01-14 16:20:30'
    ],
    [
        'id' => 4,
        'event_type' => 'file_access',
        'username' => 'user',
        'ip_address' => '192.168.1.102',
        'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
        'details' => 'Accessed sensitive file: /config/database.conf with credentials root:admin123',
        'created_at' => '2024-01-14 11:15:45'
    ]
];

// VULNERABILIDAD: Sesiones activas con datos sensibles
$user_sessions = [
    [
        'session_id' => 'sess_abc123def456ghi789',
        'username' => 'admin',
        'ip_address' => '192.168.1.100',
        'session_data' => json_encode([
            'user_id' => 1,
            'username' => 'admin',
            'role' => 'administrator',
            'permissions' => ['read', 'write', 'delete', 'admin'],
            'last_activity' => '2024-01-15 10:30:00',
            'login_time' => '2024-01-15 08:00:00'
        ]),
        'is_active' => true,
        'created_at' => '2024-01-15 08:00:00',
        'expires_at' => '2024-01-16 08:00:00'
    ],
    [
        'session_id' => 'sess_xyz789uvw456rst123',
        'username' => 'user',
        'ip_address' => '192.168.1.102',
        'session_data' => json_encode([
            'user_id' => 2,
            'username' => 'user',
            'role' => 'user',
            'permissions' => ['read'],
            'last_activity' => '2024-01-14 15:45:00',
            'login_time' => '2024-01-14 14:00:00'
        ]),
        'is_active' => true,
        'created_at' => '2024-01-14 14:00:00',
        'expires_at' => '2024-01-15 14:00:00'
    ]
];

// VULNERABILIDAD: Datos financieros sensibles
$financial_data = [
    [
        'id' => 1,
        'account_number' => '4532-1234-5678-9012', // VULNERABILIDAD: Número de tarjeta
        'account_type' => 'credit_card',
        'balance' => 15750.50,
        'currency' => 'EUR',
        'owner' => 'Empresa S.L.',
        'bank_name' => 'Banco Santander',
        'swift_code' => 'BSCHESMM', // VULNERABILIDAD: Código SWIFT expuesto
        'iban' => 'ES91 2100 0418 4502 0005 1332',
        'last_transaction' => '2024-01-15 09:30:00',
        'is_active' => true
    ],
    [
        'id' => 2,
        'account_number' => '5678-9012-3456-7890',
        'account_type' => 'business_account',
        'balance' => 125000.75,
        'currency' => 'EUR',
        'owner' => 'Empresa S.L.',
        'bank_name' => 'BBVA',
        'swift_code' => 'BBVAESMM',
        'iban' => 'ES91 0182 1234 5678 9012 3456',
        'last_transaction' => '2024-01-14 16:45:00',
        'is_active' => true
    ],
    [
        'id' => 3,
        'account_number' => '9876-5432-1098-7654',
        'account_type' => 'savings',
        'balance' => 50000.00,
        'currency' => 'EUR',
        'owner' => 'Empresa S.L.',
        'bank_name' => 'CaixaBank',
        'swift_code' => 'CAIXESBB',
        'iban' => 'ES91 2100 9876 5432 1098 7654',
        'last_transaction' => '2024-01-10 12:00:00',
        'is_active' => true
    ]
];

// VULNERABILIDAD: Función que expone todos los datos
function getAllSensitiveData() {
    global $users_data, $employees_data, $system_config, $security_logs, $user_sessions, $financial_data;
    
    return [
        'users' => $users_data,
        'employees' => $employees_data,
        'config' => $system_config,
        'logs' => $security_logs,
        'sessions' => $user_sessions,
        'financial' => $financial_data
    ];
}

// VULNERABILIDAD: Función de autenticación insegura
function authenticateUser($username, $password) {
    global $users_data;
    
    foreach ($users_data as $user) {
        // VULNERABILIDAD: Comparación de contraseñas en texto plano
        if ($user['username'] === $username && $user['password'] === $password) {
            // VULNERABILIDAD: Log de credenciales exitosas
            error_log("Successful authentication: $username with password: $password");
            return $user;
        }
    }
    
    // VULNERABILIDAD: Log de credenciales fallidas
    error_log("Failed authentication: $username with password: $password");
    return false;
}

// VULNERABILIDAD: Función que obtiene usuarios con contraseñas
function getUsersWithPasswords() {
    global $users_data;
    return $users_data;
}

// VULNERABILIDAD: Función que obtiene empleados con datos sensibles
function getEmployeesWithSensitiveData() {
    global $employees_data;
    return $employees_data;
}

// VULNERABILIDAD: Función que obtiene configuraciones sensibles
function getSensitiveConfig() {
    global $system_config;
    return array_filter($system_config, function($config) {
        return $config['is_sensitive'] === true;
    });
}

// VULNERABILIDAD: Función que obtiene datos financieros
function getFinancialData() {
    global $financial_data;
    return $financial_data;
}

// VULNERABILIDAD: Función que obtiene logs de seguridad
function getSecurityLogs() {
    global $security_logs;
    return $security_logs;
}

// VULNERABILIDAD: Función que obtiene sesiones activas
function getActiveSessions() {
    global $user_sessions;
    return array_filter($user_sessions, function($session) {
        return $session['is_active'] === true;
    });
}

// VULNERABILIDAD: Función de búsqueda vulnerable a inyección
function searchData($table, $field, $value) {
    global $users_data, $employees_data, $system_config, $security_logs, $user_sessions, $financial_data;
    
    $data = [];
    switch ($table) {
        case 'users':
            $data = $users_data;
            break;
        case 'employees':
            $data = $employees_data;
            break;
        case 'config':
            $data = $system_config;
            break;
        case 'logs':
            $data = $security_logs;
            break;
        case 'sessions':
            $data = $user_sessions;
            break;
        case 'financial':
            $data = $financial_data;
            break;
    }
    
    // VULNERABILIDAD: Búsqueda sin validación
    $results = [];
    foreach ($data as $item) {
        if (isset($item[$field]) && strpos(strtolower($item[$field]), strtolower($value)) !== false) {
            $results[] = $item;
        }
    }
    
    // VULNERABILIDAD: Log de búsquedas con datos sensibles
    error_log("Search performed: table=$table, field=$field, value=$value, results=" . count($results));
    
    return $results;
}

// VULNERABILIDAD: Auto-ejecución si se accede directamente
if (basename($_SERVER['PHP_SELF']) === 'sample_data.php') {
    header('Content-Type: text/html; charset=utf-8');
    
    echo "<!DOCTYPE html>";
    echo "<html><head><title>Datos de Muestra - VULNERABILIDAD</title>";
    echo "<style>";
    echo "body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }";
    echo ".container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }";
    echo ".warning { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0; border: 1px solid #f5c6cb; }";
    echo ".data-section { margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 5px; }";
    echo ".sensitive { background: #d4edda; color: #155724; padding: 10px; border-radius: 3px; margin: 5px 0; }";
    echo "pre { background: #e9ecef; padding: 10px; border-radius: 3px; overflow-x: auto; }";
    echo "</style></head><body>";
    
    echo "<div class='container'>";
    echo "<h1>🔍 Datos de Muestra del Sistema</h1>";
    
    echo "<div class='warning'>";
    echo "<strong>⚠️ VULNERABILIDAD CRÍTICA:</strong> Este archivo expone datos sensibles de la aplicación incluyendo:<br>";
    echo "• Contraseñas en texto plano<br>";
    echo "• Información financiera<br>";
    echo "• Datos personales de empleados<br>";
    echo "• Claves de API y configuraciones<br>";
    echo "• Logs de seguridad con credenciales";
    echo "</div>";
    
    echo "<div class='data-section'>";
    echo "<h3>👥 Usuarios del Sistema</h3>";
    echo "<div class='sensitive'>Contraseñas expuestas en texto plano</div>";
    echo "<pre>" . htmlspecialchars(json_encode($users_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
    echo "</div>";
    
    echo "<div class='data-section'>";
    echo "<h3>👨‍💼 Empleados</h3>";
    echo "<div class='sensitive'>Información personal sensible: SSN, cuentas bancarias, salarios</div>";
    echo "<pre>" . htmlspecialchars(json_encode($employees_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
    echo "</div>";
    
    echo "<div class='data-section'>";
    echo "<h3>⚙️ Configuraciones del Sistema</h3>";
    echo "<div class='sensitive'>Claves de API, contraseñas de servicios, secretos JWT</div>";
    echo "<pre>" . htmlspecialchars(json_encode($system_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
    echo "</div>";
    
    echo "<div class='data-section'>";
    echo "<h3>💰 Datos Financieros</h3>";
    echo "<div class='sensitive'>Números de cuenta, IBAN, códigos SWIFT, balances</div>";
    echo "<pre>" . htmlspecialchars(json_encode($financial_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
    echo "</div>";
    
    echo "<div class='data-section'>";
    echo "<h3>📋 Logs de Seguridad</h3>";
    echo "<div class='sensitive'>Contraseñas y claves registradas en logs</div>";
    echo "<pre>" . htmlspecialchars(json_encode($security_logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
    echo "</div>";
    
    echo "<div class='data-section'>";
    echo "<h3>🔐 Sesiones Activas</h3>";
    echo "<div class='sensitive'>Datos de sesión con información de usuarios</div>";
    echo "<pre>" . htmlspecialchars(json_encode($user_sessions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";
    echo "</div>";
    
    echo "<h3>🔗 Enlaces de Navegación</h3>";
    echo "<a href='index.php'>🏠 Inicio</a> | ";
    echo "<a href='login.php'>🔑 Login</a> | ";
    echo "<a href='admin.php'>👨‍💼 Admin</a> | ";
    echo "<a href='config.php'>⚙️ Config</a> | ";
    echo "<a href='info.php'>ℹ️ Info</a>";
    
    echo "</div>";
    echo "</body></html>";
}

// VULNERABILIDAD: Información expuesta en JavaScript
echo "<script>";
echo "console.log('Sample Data Loaded');";
echo "console.log('Users:', " . json_encode($users_data) . ");";
echo "console.log('Employees:', " . json_encode($employees_data) . ");";
echo "console.log('System Config:', " . json_encode($system_config) . ");";
echo "console.log('Financial Data:', " . json_encode($financial_data) . ");";
echo "</script>";
?>