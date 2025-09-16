<?php
// VULNERABILIDAD: Archivo de conexión a BD accesible públicamente
// Este archivo debería estar fuera del directorio web

// VULNERABILIDAD: Exposición de errores en producción
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// VULNERABILIDAD: Credenciales hardcodeadas
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'empresa_db');
define('DB_PORT', 3306);

// VULNERABILIDAD: Información sensible en comentarios
// Backup DB: mysql://backup:backup123@192.168.1.100:3306/empresa_backup
// Test DB: mysql://test:test123@localhost:3307/empresa_test
// Production DB: mysql://prod_user:Felipe883344@@localhost:3306/empresa_prod

class DatabaseConnection {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        try {
            // VULNERABILIDAD: Conexión sin SSL
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                // VULNERABILIDAD: SSL deshabilitado
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                PDO::MYSQL_ATTR_SSL_CA => null
            ];
            
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);
            
            // VULNERABILIDAD: Logging de credenciales
            error_log("Database connection established: " . DB_USER . "@" . DB_HOST . ":" . DB_PORT . "/" . DB_NAME);
            
        } catch (PDOException $e) {
            // VULNERABILIDAD: Exposición de información de conexión en errores
            die("Error de conexión a la base de datos: " . $e->getMessage() . "\n" .
                "Host: " . DB_HOST . "\n" .
                "Usuario: " . DB_USER . "\n" .
                "Base de datos: " . DB_NAME . "\n" .
                "Puerto: " . DB_PORT);
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // VULNERABILIDAD: Método que expone credenciales
    public function getConnectionInfo() {
        return [
            'host' => DB_HOST,
            'user' => DB_USER,
            'password' => DB_PASS, // VULNERABILIDAD: Contraseña expuesta
            'database' => DB_NAME,
            'port' => DB_PORT
        ];
    }
    
    // VULNERABILIDAD: Query directo sin preparación
    public function directQuery($sql) {
        try {
            // VULNERABILIDAD: Susceptible a inyección SQL
            $result = $this->connection->query($sql);
            error_log("Direct query executed: " . $sql);
            return $result;
        } catch (PDOException $e) {
            // VULNERABILIDAD: Exposición de query en error
            throw new Exception("Error en query: " . $e->getMessage() . "\nQuery: " . $sql);
        }
    }
    
    // VULNERABILIDAD: Método para obtener usuarios con contraseñas
    public function getAllUsersWithPasswords() {
        $sql = "SELECT username, password, email, role FROM users";
        return $this->directQuery($sql)->fetchAll();
    }
    
    // VULNERABILIDAD: Método para obtener configuraciones sensibles
    public function getSensitiveConfig() {
        $sql = "SELECT config_key, config_value FROM system_config WHERE is_sensitive = TRUE";
        return $this->directQuery($sql)->fetchAll();
    }
    
    // VULNERABILIDAD: Método para obtener datos financieros
    public function getFinancialData() {
        $sql = "SELECT * FROM financial_data";
        return $this->directQuery($sql)->fetchAll();
    }
    
    // VULNERABILIDAD: Método para obtener empleados con información sensible
    public function getEmployeesWithSensitiveData() {
        $sql = "SELECT first_name, last_name, email, salary, ssn, bank_account FROM employees";
        return $this->directQuery($sql)->fetchAll();
    }
    
    // VULNERABILIDAD: Método para obtener logs de seguridad
    public function getSecurityLogs() {
        $sql = "SELECT * FROM security_logs ORDER BY created_at DESC LIMIT 50";
        return $this->directQuery($sql)->fetchAll();
    }
    
    // VULNERABILIDAD: Método para obtener sesiones activas
    public function getActiveSessions() {
        $sql = "SELECT session_id, username, ip_address, session_data FROM user_sessions WHERE is_active = TRUE";
        return $this->directQuery($sql)->fetchAll();
    }
    
    // VULNERABILIDAD: Método de autenticación inseguro
    public function authenticateUser($username, $password) {
        // VULNERABILIDAD: Query vulnerable a inyección SQL
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        
        try {
            $result = $this->directQuery($sql);
            $user = $result->fetch();
            
            if ($user) {
                // VULNERABILIDAD: Logging de credenciales exitosas
                error_log("Successful login: $username with password: $password");
                
                // VULNERABILIDAD: Actualizar último login sin prepared statement
                $updateSql = "UPDATE users SET last_login = NOW() WHERE username = '$username'";
                $this->directQuery($updateSql);
                
                return $user;
            } else {
                // VULNERABILIDAD: Logging de intentos fallidos con contraseña
                error_log("Failed login attempt: $username with password: $password");
                return false;
            }
        } catch (Exception $e) {
            // VULNERABILIDAD: Exposición de query en error
            error_log("Authentication error: " . $e->getMessage() . " Query: " . $sql);
            return false;
        }
    }
    
    // VULNERABILIDAD: Método para ejecutar queries arbitrarios
    public function executeArbitraryQuery($query) {
        // VULNERABILIDAD: Permite ejecución de cualquier SQL
        try {
            $result = $this->connection->query($query);
            error_log("Arbitrary query executed: " . $query);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error executing query: " . $e->getMessage() . "\nQuery: " . $query);
        }
    }
    
    // VULNERABILIDAD: Método de backup inseguro
    public function createBackup() {
        $backupData = [
            'users' => $this->getAllUsersWithPasswords(),
            'employees' => $this->getEmployeesWithSensitiveData(),
            'config' => $this->getSensitiveConfig(),
            'financial' => $this->getFinancialData(),
            'logs' => $this->getSecurityLogs(),
            'sessions' => $this->getActiveSessions()
        ];
        
        // VULNERABILIDAD: Backup sin cifrar
        $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.json';
        file_put_contents($backupFile, json_encode($backupData, JSON_PRETTY_PRINT));
        
        error_log("Backup created: " . $backupFile . " with sensitive data");
        return $backupFile;
    }
    
    // VULNERABILIDAD: Método para obtener información del servidor de BD
    public function getDatabaseServerInfo() {
        $info = [];
        
        try {
            // Información del servidor
            $info['version'] = $this->connection->query('SELECT VERSION()')->fetchColumn();
            $info['user'] = $this->connection->query('SELECT USER()')->fetchColumn();
            $info['database'] = $this->connection->query('SELECT DATABASE()')->fetchColumn();
            
            // Variables del sistema
            $variables = $this->connection->query('SHOW VARIABLES')->fetchAll();
            $info['variables'] = $variables;
            
            // Procesos activos
            $processes = $this->connection->query('SHOW PROCESSLIST')->fetchAll();
            $info['processes'] = $processes;
            
            // Bases de datos disponibles
            $databases = $this->connection->query('SHOW DATABASES')->fetchAll();
            $info['databases'] = $databases;
            
            return $info;
        } catch (PDOException $e) {
            error_log("Error getting database server info: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
    
    public function __destruct() {
        // VULNERABILIDAD: Logging de desconexión con información sensible
        if ($this->connection) {
            error_log("Database connection closed for user: " . DB_USER . " at " . date('Y-m-d H:i:s'));
        }
    }
}

// VULNERABILIDAD: Función global que expone credenciales
function getDbCredentials() {
    return [
        'host' => DB_HOST,
        'user' => DB_USER,
        'password' => DB_PASS,
        'database' => DB_NAME,
        'port' => DB_PORT
    ];
}

// VULNERABILIDAD: Función para test de conexión que expone información
function testDatabaseConnection() {
    try {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        
        echo "<h3>✅ Conexión a Base de Datos Exitosa</h3>";
        echo "<p><strong>Host:</strong> " . DB_HOST . "</p>";
        echo "<p><strong>Usuario:</strong> " . DB_USER . "</p>";
        echo "<p><strong>Contraseña:</strong> " . DB_PASS . "</p>"; // VULNERABILIDAD
        echo "<p><strong>Base de Datos:</strong> " . DB_NAME . "</p>";
        echo "<p><strong>Puerto:</strong> " . DB_PORT . "</p>";
        
        // VULNERABILIDAD: Mostrar información del servidor
        $version = $connection->query('SELECT VERSION()')->fetchColumn();
        echo "<p><strong>Versión MySQL:</strong> " . $version . "</p>";
        
        $user = $connection->query('SELECT USER()')->fetchColumn();
        echo "<p><strong>Usuario Actual:</strong> " . $user . "</p>";
        
        return true;
    } catch (Exception $e) {
        echo "<h3>❌ Error de Conexión</h3>";
        echo "<p>" . $e->getMessage() . "</p>";
        return false;
    }
}

// VULNERABILIDAD: Auto-ejecución de test si se accede directamente
if (basename($_SERVER['PHP_SELF']) === 'db_connection.php') {
    echo "<!DOCTYPE html>";
    echo "<html><head><title>Test de Conexión DB</title></head><body>";
    echo "<h1>🔍 Test de Conexión a Base de Datos</h1>";
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<strong>⚠️ VULNERABILIDAD:</strong> Archivo de conexión accesible públicamente";
    echo "</div>";
    
    testDatabaseConnection();
    
    echo "<h3>📊 Información Adicional del Sistema</h3>";
    echo "<p><strong>PHP Version:</strong> " . PHP_VERSION . "</p>";
    echo "<p><strong>Server:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
    echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
    
    echo "<h3>🔗 Enlaces de Navegación</h3>";
    echo "<a href='index.php'>🏠 Inicio</a> | ";
    echo "<a href='admin.php'>👨‍💼 Admin</a> | ";
    echo "<a href='config.php'>⚙️ Config</a> | ";
    echo "<a href='info.php'>ℹ️ Info</a>";
    
    echo "</body></html>";
}

// VULNERABILIDAD: Información expuesta en JavaScript
echo "<script>";
echo "console.log('Database Connection Info:', " . json_encode(getDbCredentials()) . ");";
echo "console.log('Connection file loaded: db_connection.php');";
echo "</script>";
?>