-- =====================================================
-- BASE DE DATOS PARA DEMOSTRACIÓN DE VULNERABILIDADES
-- Sistema Empresarial con Configuraciones Inseguras
-- =====================================================

-- VULNERABILIDAD: Credenciales por defecto en comentarios
-- Usuario: root
-- Contraseña: admin123
-- Base de datos: empresa_db

CREATE DATABASE IF NOT EXISTS empresa_db;
USE empresa_db;

-- =====================================================
-- TABLA DE USUARIOS
-- =====================================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- VULNERABILIDAD: Contraseñas en texto plano
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user', 'guest', 'tester') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    failed_attempts INT DEFAULT 0,
    -- VULNERABILIDAD: Información sensible en comentarios
    -- Contraseña de emergencia: emergency123
    emergency_access VARCHAR(255) DEFAULT 'emergency123'
);

-- VULNERABILIDAD: Usuarios por defecto con contraseñas débiles
INSERT INTO users (username, password, email, role) VALUES
('admin', 'admin123', 'admin@empresa.com', 'admin'),
('user', 'password', 'user@empresa.com', 'user'),
('guest', 'guest', 'guest@empresa.com', 'guest'),
('test', 'test123', 'test@empresa.com', 'tester'),
('demo', 'demo', 'demo@empresa.com', 'user'),
('root', 'root', 'root@empresa.com', 'admin'),
('administrator', 'administrator', 'administrator@empresa.com', 'admin'),
('sa', 'sa', 'sa@empresa.com', 'admin'),
('manager', '123456', 'manager@empresa.com', 'user'),
('supervisor', 'password123', 'supervisor@empresa.com', 'user');

-- =====================================================
-- TABLA DE EMPLEADOS
-- =====================================================
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    department VARCHAR(50),
    position VARCHAR(50),
    salary DECIMAL(10,2), -- VULNERABILIDAD: Salarios sin cifrar
    ssn VARCHAR(11), -- VULNERABILIDAD: SSN sin cifrar
    date_of_birth DATE,
    address TEXT,
    emergency_contact VARCHAR(100),
    emergency_phone VARCHAR(20),
    bank_account VARCHAR(20), -- VULNERABILIDAD: Información bancaria sin cifrar
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- VULNERABILIDAD: Datos sensibles de empleados expuestos
INSERT INTO employees (employee_id, first_name, last_name, email, phone, department, position, salary, ssn, date_of_birth, address, emergency_contact, emergency_phone, bank_account) VALUES
('EMP001', 'Juan', 'Pérez', 'juan.perez@empresa.com', '555-0101', 'IT', 'Desarrollador Senior', 75000.00, '123-45-6789', '1985-03-15', '123 Main St, Ciudad', 'María Pérez', '555-0102', '1234567890'),
('EMP002', 'María', 'García', 'maria.garcia@empresa.com', '555-0201', 'RRHH', 'Gerente de RRHH', 85000.00, '987-65-4321', '1982-07-22', '456 Oak Ave, Ciudad', 'Carlos García', '555-0202', '0987654321'),
('EMP003', 'Carlos', 'López', 'carlos.lopez@empresa.com', '555-0301', 'Finanzas', 'Contador', 65000.00, '456-78-9123', '1988-11-08', '789 Pine St, Ciudad', 'Ana López', '555-0302', '1122334455'),
('EMP004', 'Ana', 'Martínez', 'ana.martinez@empresa.com', '555-0401', 'Marketing', 'Especialista en Marketing', 55000.00, '321-54-9876', '1990-05-12', '321 Elm St, Ciudad', 'Luis Martínez', '555-0402', '5566778899'),
('EMP005', 'Luis', 'Rodríguez', 'luis.rodriguez@empresa.com', '555-0501', 'IT', 'Administrador de Sistemas', 70000.00, '654-32-1098', '1987-09-30', '654 Maple Ave, Ciudad', 'Carmen Rodríguez', '555-0502', '9988776655');

-- =====================================================
-- TABLA DE CONFIGURACIONES
-- =====================================================
CREATE TABLE system_config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    config_key VARCHAR(100) NOT NULL UNIQUE,
    config_value TEXT NOT NULL,
    description TEXT,
    is_sensitive BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- VULNERABILIDAD: Configuraciones sensibles en base de datos
INSERT INTO system_config (config_key, config_value, description, is_sensitive) VALUES
('db_host', 'localhost', 'Host de la base de datos', FALSE),
('db_user', 'root', 'Usuario de la base de datos', TRUE),
('db_password', 'admin123', 'Contraseña de la base de datos', TRUE),
('db_name', 'empresa_db', 'Nombre de la base de datos', FALSE),
('secret_key', 'my_super_secret_key_123', 'Clave secreta de la aplicación', TRUE),
('jwt_secret', 'jwt_secret_key_456', 'Clave secreta para JWT', TRUE),
('encryption_key', 'encryption_key_789', 'Clave de cifrado', TRUE),
('api_secret', 'api_secret_abc123', 'Clave secreta de API', TRUE),
('stripe_public_key', 'pk_live_1234567890abcdef', 'Clave pública de Stripe', TRUE),
('stripe_secret_key', 'sk_live_1234567890abcdef', 'Clave secreta de Stripe', TRUE),
('paypal_client_id', 'AQkquBDf1zctJOWGKWUEtKXm6qVhueUEMvXO', 'Client ID de PayPal', TRUE),
('paypal_client_secret', 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL', 'Client Secret de PayPal', TRUE),
('aws_access_key', 'AKIAIOSFODNN7EXAMPLE', 'Access Key de AWS', TRUE),
('aws_secret_key', 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY', 'Secret Key de AWS', TRUE),
('google_api_key', 'AIzaSyDaGmWKa4JsXZ-HjGw7ISLn_3namBGewQe', 'API Key de Google', TRUE),
('smtp_host', 'smtp.gmail.com', 'Host SMTP', FALSE),
('smtp_user', 'empresa@gmail.com', 'Usuario SMTP', TRUE),
('smtp_password', 'password123', 'Contraseña SMTP', TRUE),
('ftp_host', 'ftp.empresa.com', 'Host FTP', FALSE),
('ftp_user', 'ftpuser', 'Usuario FTP', TRUE),
('ftp_password', 'ftppass123', 'Contraseña FTP', TRUE),
('backup_encryption', 'false', 'Cifrado de backups', FALSE),
('log_sensitive_data', 'true', 'Registrar datos sensibles', FALSE),
('debug_mode', 'true', 'Modo debug activado', FALSE),
('allow_file_uploads', 'true', 'Permitir subida de archivos', FALSE),
('max_file_size', '100MB', 'Tamaño máximo de archivo', FALSE),
('allowed_extensions', '*', 'Extensiones permitidas', FALSE);

-- =====================================================
-- TABLA DE LOGS DE SEGURIDAD
-- =====================================================
CREATE TABLE security_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_type VARCHAR(50) NOT NULL,
    username VARCHAR(50),
    ip_address VARCHAR(45),
    user_agent TEXT,
    event_data JSON, -- VULNERABILIDAD: Datos sensibles en logs
    severity ENUM('LOW', 'MEDIUM', 'HIGH', 'CRITICAL') DEFAULT 'LOW',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- VULNERABILIDAD: Logs con información sensible
INSERT INTO security_logs (event_type, username, ip_address, user_agent, event_data, severity) VALUES
('LOGIN_SUCCESS', 'admin', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"password": "admin123", "session_id": "sess_123456"}', 'LOW'),
('LOGIN_FAILED', 'hacker', '192.168.1.200', 'curl/7.68.0', '{"attempted_password": "password123", "attempts": 5}', 'HIGH'),
('CONFIG_ACCESS', 'admin', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"accessed_config": "db_password", "value": "admin123"}', 'MEDIUM'),
('FILE_UPLOAD', 'user', '192.168.1.150', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"filename": "malicious.php", "size": 1024}', 'CRITICAL'),
('PHPINFO_ACCESS', 'guest', '192.168.1.180', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"full_phpinfo": true, "exposed_vars": ["DB_PASSWORD", "SECRET_KEY"]}', 'HIGH');

-- =====================================================
-- TABLA DE SESIONES
-- =====================================================
CREATE TABLE user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(128) NOT NULL UNIQUE,
    user_id INT,
    username VARCHAR(50),
    ip_address VARCHAR(45),
    user_agent TEXT,
    session_data TEXT, -- VULNERABILIDAD: Datos de sesión sin cifrar
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    expires_at TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- VULNERABILIDAD: Sesiones con datos sensibles expuestos
INSERT INTO user_sessions (session_id, user_id, username, ip_address, user_agent, session_data, expires_at) VALUES
('sess_admin_123456', 1, 'admin', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"role": "admin", "permissions": ["all"], "last_login": "2024-01-15 10:30:00"}', DATE_ADD(NOW(), INTERVAL 24 HOUR)),
('sess_user_789012', 2, 'user', '192.168.1.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"role": "user", "department": "IT", "salary": 50000}', DATE_ADD(NOW(), INTERVAL 8 HOUR)),
('sess_guest_345678', 3, 'guest', '192.168.1.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '{"role": "guest", "temp_access": true}', DATE_ADD(NOW(), INTERVAL 2 HOUR));

-- =====================================================
-- TABLA DE INFORMACIÓN FINANCIERA
-- =====================================================
CREATE TABLE financial_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_type VARCHAR(50) NOT NULL,
    account_number VARCHAR(50) NOT NULL, -- VULNERABILIDAD: Sin cifrado
    routing_number VARCHAR(20),
    account_holder VARCHAR(100),
    balance DECIMAL(15,2),
    currency VARCHAR(3) DEFAULT 'USD',
    bank_name VARCHAR(100),
    swift_code VARCHAR(20),
    iban VARCHAR(50),
    credit_limit DECIMAL(15,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- VULNERABILIDAD: Información financiera sin protección
INSERT INTO financial_data (account_type, account_number, routing_number, account_holder, balance, bank_name, swift_code, iban, credit_limit) VALUES
('CHECKING', '1234567890', '021000021', 'Empresa S.A.', 250000.00, 'Banco Nacional', 'BOFAUS3N', 'US64BOFA00001234567890', NULL),
('SAVINGS', '0987654321', '021000021', 'Empresa S.A.', 500000.00, 'Banco Nacional', 'BOFAUS3N', 'US64BOFA00000987654321', NULL),
('CREDIT', '4532123456789012', NULL, 'Empresa S.A.', -15000.00, 'Banco de Crédito', NULL, NULL, 100000.00),
('CREDIT', '5555444433332222', NULL, 'Empresa S.A.', -8500.00, 'Banco Internacional', NULL, NULL, 50000.00);

-- =====================================================
-- VISTAS CON INFORMACIÓN SENSIBLE
-- =====================================================

-- VULNERABILIDAD: Vista que expone información sensible
CREATE VIEW sensitive_user_data AS
SELECT 
    u.username,
    u.password, -- VULNERABILIDAD: Contraseña en vista
    u.email,
    u.role,
    e.salary,
    e.ssn,
    e.bank_account
FROM users u
LEFT JOIN employees e ON u.username = CONCAT(LOWER(e.first_name), '.', LOWER(e.last_name));

-- VULNERABILIDAD: Vista con configuraciones críticas
CREATE VIEW critical_config AS
SELECT 
    config_key,
    config_value,
    description
FROM system_config
WHERE is_sensitive = TRUE;

-- =====================================================
-- PROCEDIMIENTOS ALMACENADOS INSEGUROS
-- =====================================================

-- VULNERABILIDAD: Procedimiento que expone contraseñas
DELIMITER //
CREATE PROCEDURE GetUserCredentials(IN input_username VARCHAR(50))
BEGIN
    -- VULNERABILIDAD: Sin validación de entrada
    SET @sql = CONCAT('SELECT username, password, email FROM users WHERE username = "', input_username, '"');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //
DELIMITER ;

-- VULNERABILIDAD: Procedimiento que registra información sensible
DELIMITER //
CREATE PROCEDURE LogSensitiveAction(IN action_type VARCHAR(50), IN user_data JSON)
BEGIN
    INSERT INTO security_logs (event_type, username, event_data, severity)
    VALUES (action_type, JSON_EXTRACT(user_data, '$.username'), user_data, 'HIGH');
END //
DELIMITER ;

-- =====================================================
-- TRIGGERS INSEGUROS
-- =====================================================

-- VULNERABILIDAD: Trigger que registra contraseñas
DELIMITER //
CREATE TRIGGER log_password_changes
AFTER UPDATE ON users
FOR EACH ROW
BEGIN
    IF OLD.password != NEW.password THEN
        INSERT INTO security_logs (event_type, username, event_data, severity)
        VALUES ('PASSWORD_CHANGE', NEW.username, 
                JSON_OBJECT('old_password', OLD.password, 'new_password', NEW.password), 
                'MEDIUM');
    END IF;
END //
DELIMITER ;

-- =====================================================
-- USUARIOS DE BASE DE DATOS INSEGUROS
-- =====================================================

-- VULNERABILIDAD: Usuarios con privilegios excesivos
-- Nota: Estos comandos son para demostración, pueden requerir privilegios de administrador

-- CREATE USER 'webapp'@'%' IDENTIFIED BY 'password123';
-- GRANT ALL PRIVILEGES ON empresa_db.* TO 'webapp'@'%';

-- CREATE USER 'readonly'@'%' IDENTIFIED BY 'readonly';
-- GRANT SELECT ON empresa_db.* TO 'readonly'@'%';

-- CREATE USER 'backup'@'%' IDENTIFIED BY 'backup123';
-- GRANT SELECT, LOCK TABLES ON empresa_db.* TO 'backup'@'%';

-- FLUSH PRIVILEGES;

-- =====================================================
-- DATOS DE PRUEBA ADICIONALES
-- =====================================================

-- Más empleados para pruebas
INSERT INTO employees (employee_id, first_name, last_name, email, phone, department, position, salary, ssn, date_of_birth, address, emergency_contact, emergency_phone, bank_account) VALUES
('EMP006', 'Roberto', 'Silva', 'roberto.silva@empresa.com', '555-0601', 'Ventas', 'Representante de Ventas', 45000.00, '789-12-3456', '1992-02-14', '987 Cedar St, Ciudad', 'Elena Silva', '555-0602', '1357924680'),
('EMP007', 'Patricia', 'Morales', 'patricia.morales@empresa.com', '555-0701', 'Legal', 'Abogada Corporativa', 95000.00, '147-25-8369', '1980-12-03', '147 Birch Ave, Ciudad', 'Miguel Morales', '555-0702', '2468135790'),
('EMP008', 'Fernando', 'Castro', 'fernando.castro@empresa.com', '555-0801', 'IT', 'Analista de Seguridad', 80000.00, '258-36-9470', '1986-08-17', '258 Spruce St, Ciudad', 'Lucía Castro', '555-0802', '3691470258');

-- Más configuraciones sensibles
INSERT INTO system_config (config_key, config_value, description, is_sensitive) VALUES
('ldap_server', 'ldap://192.168.1.50:389', 'Servidor LDAP', FALSE),
('ldap_bind_dn', 'cn=admin,dc=empresa,dc=com', 'DN de enlace LDAP', TRUE),
('ldap_bind_password', 'ldap_admin_pass', 'Contraseña de enlace LDAP', TRUE),
('redis_host', '192.168.1.60', 'Host de Redis', FALSE),
('redis_password', 'redis_pass_123', 'Contraseña de Redis', TRUE),
('elasticsearch_url', 'http://192.168.1.70:9200', 'URL de Elasticsearch', FALSE),
('elasticsearch_user', 'elastic', 'Usuario de Elasticsearch', TRUE),
('elasticsearch_password', 'elastic_pass', 'Contraseña de Elasticsearch', TRUE);

-- =====================================================
-- COMENTARIOS FINALES
-- =====================================================

/*
Esta base de datos contiene múltiples vulnerabilidades de configuración:

1. CREDENCIALES POR DEFECTO:
   - Usuarios con contraseñas débiles (admin/admin123, user/password)
   - Credenciales hardcodeadas en comentarios

2. INFORMACIÓN SENSIBLE SIN CIFRAR:
   - Contraseñas en texto plano
   - SSN y datos bancarios sin protección
   - Claves API y secretos expuestos

3. CONFIGURACIONES INSEGURAS:
   - Procedimientos almacenados vulnerables a inyección SQL
   - Triggers que registran contraseñas
   - Vistas que exponen información crítica

4. LOGGING INSEGURO:
   - Contraseñas registradas en logs
   - Datos de sesión sin cifrar
   - Información sensible en eventos de auditoría

5. PRIVILEGIOS EXCESIVOS:
   - Usuarios con más permisos de los necesarios
   - Acceso sin restricciones a datos sensibles

Para usar esta base de datos:
1. Importar este archivo SQL en MySQL/MariaDB
2. Configurar la aplicación PHP para conectarse
3. Usar las credenciales por defecto para demostrar vulnerabilidades

Credenciales de prueba:
- admin / admin123 (Administrador)
- user / password (Usuario normal)
- guest / guest (Invitado)
- test / test123 (Pruebas)
*/

-- Mostrar resumen de datos insertados
SELECT 'RESUMEN DE LA BASE DE DATOS' as info;
SELECT COUNT(*) as total_usuarios FROM users;
SELECT COUNT(*) as total_empleados FROM employees;
SELECT COUNT(*) as total_configuraciones FROM system_config;
SELECT COUNT(*) as configuraciones_sensibles FROM system_config WHERE is_sensitive = TRUE;
SELECT COUNT(*) as total_logs FROM security_logs;
SELECT COUNT(*) as total_sesiones FROM user_sessions;
SELECT COUNT(*) as total_cuentas_financieras FROM financial_data;