# 🔐 Aplicación de Demostración - Vulnerabilidades de Configuración de Seguridad

## 📋 Descripción

Esta aplicación web ha sido desarrollada específicamente para demostrar **vulnerabilidades de configuración de seguridad** (Security Misconfiguration) según el OWASP Top 10. La aplicación simula un sistema empresarial con múltiples fallos de seguridad intencionalmente implementados para fines educativos.

## 🚀 Cómo Ejecutar la Aplicación

### Requisitos Previos
- PHP 7.4 o superior
- Navegador web moderno

### Instrucciones de Ejecución

1. **Iniciar el servidor PHP:**
   ```bash
   php -S localhost:8081 -t EjemPractico
   ```

2. **Acceder a la aplicación:**
   - Abrir navegador en: `http://localhost:8081`

3. **Explorar las vulnerabilidades:**
   - Navegar por las diferentes páginas
   - Probar las credenciales expuestas
   - Revisar la consola del navegador
   - Examinar el código fuente

## 🎯 Páginas y Funcionalidades

### 🏠 Página Principal (`index.php`)
- **Propósito:** Punto de entrada con información general
- **Vulnerabilidades:**
  - Información del sistema expuesta
  - Configuraciones PHP inseguras
  - Datos sensibles en JavaScript

### 🔑 Página de Login (`login.php`)
- **Propósito:** Autenticación de usuarios
- **Vulnerabilidades:**
  - Credenciales por defecto débiles
  - Contraseñas expuestas públicamente
  - Logging inseguro de credenciales
  - Mensajes de error detallados

### 👨‍💼 Panel de Administración (`admin.php`)
- **Propósito:** Gestión administrativa
- **Vulnerabilidades:**
  - Acceso sin autenticación adecuada
  - Exposición de datos financieros
  - Información personal sensible (SSN, cuentas bancarias)
  - Contraseñas de usuarios en texto plano

### ⚙️ Configuraciones (`config.php`)
- **Propósito:** Configuraciones del sistema
- **Vulnerabilidades:**
  - Archivo de configuración accesible públicamente
  - Credenciales de base de datos expuestas
  - Claves de API y secretos en texto plano
  - Configuraciones PHP inseguras

### ℹ️ Información del Sistema (`info.php`)
- **Propósito:** Información técnica del servidor
- **Vulnerabilidades:**
  - `phpinfo()` accesible públicamente
  - Variables de entorno expuestas
  - Información del servidor detallada
  - Configuraciones internas visibles

### 🗄️ Conexión a Base de Datos (`db_connection.php`)
- **Propósito:** Gestión de conexiones a BD
- **Vulnerabilidades:**
  - Archivo de conexión accesible públicamente
  - Credenciales hardcodeadas
  - Información de conexión expuesta
  - Métodos inseguros de autenticación

### 📊 Datos de Muestra (`sample_data.php`)
- **Propósito:** Simulación de base de datos
- **Vulnerabilidades:**
  - Datos sensibles accesibles públicamente
  - Información financiera expuesta
  - Datos personales sin protección
  - Logs de seguridad con credenciales

## 🔓 Credenciales de Prueba

| Usuario | Contraseña | Rol | Estado |
|---------|------------|-----|--------|
| admin | admin123 | administrator | Activo |
| user | user123 | user | Activo |
| guest | guest | guest | Activo |
| test | 123456 | tester | Inactivo |
| developer | dev2024! | developer | Activo |

## 🎯 Cómo Demostrar las Vulnerabilidades

### 1. **Acceso No Autorizado**
- Acceder directamente a `admin.php` sin autenticación
- El sistema permite acceso con escalación automática de privilegios

### 2. **Exposición de Credenciales**
- Visitar `login.php` para ver todas las credenciales disponibles
- Revisar `config.php` para credenciales de base de datos
- Examinar `sample_data.php` para datos completos

### 3. **Información Sensible Expuesta**
- Acceder a `info.php` para ver `phpinfo()`
- Revisar `db_connection.php` para test de conexión
- Examinar la consola del navegador en cualquier página

### 4. **Datos Financieros y Personales**
- En `admin.php` ver:
  - Salarios de empleados
  - Números de Seguridad Social (SSN)
  - Cuentas bancarias
  - Información financiera completa

### 5. **Configuraciones Inseguras**
- `config.php` muestra:
  - Claves de API
  - Secretos JWT
  - Contraseñas de servicios
  - Configuraciones de cifrado

### 6. **Logging Inseguro**
- Intentar login con credenciales incorrectas
- Las contraseñas se registran en logs del servidor
- Información sensible en logs de errores

## ⚠️ Vulnerabilidades Implementadas

### 🔴 Críticas
1. **Credenciales por Defecto**
   - Usuarios con contraseñas débiles y predecibles
   - Credenciales hardcodeadas en código

2. **Exposición de Información Sensible**
   - Datos financieros accesibles sin autenticación
   - Información personal (SSN, cuentas bancarias)
   - Credenciales de base de datos expuestas

3. **Archivos de Configuración Accesibles**
   - `config.php` accesible públicamente
   - `db_connection.php` con credenciales
   - `sample_data.php` con todos los datos

### 🟡 Altas
4. **Configuraciones PHP Inseguras**
   - `display_errors` habilitado en producción
   - `allow_url_fopen` habilitado
   - Headers de seguridad faltantes

5. **Logging Inseguro**
   - Contraseñas registradas en logs
   - Información sensible en logs de errores
   - Logs accesibles sin protección

6. **Falta de Control de Acceso**
   - Páginas administrativas sin autenticación
   - Escalación automática de privilegios
   - Acceso directo a archivos sensibles

### 🟠 Medias
7. **Información de Debug Expuesta**
   - `phpinfo()` accesible públicamente
   - Variables de entorno expuestas
   - Información del servidor detallada

8. **Validación Insuficiente**
   - Sin protección contra fuerza bruta
   - Validación débil de credenciales
   - Mensajes de error detallados

## 🛡️ Medidas de Mitigación Recomendadas

### 1. **Configuración Segura**
- Deshabilitar `display_errors` en producción
- Configurar headers de seguridad apropiados
- Usar configuraciones PHP seguras

### 2. **Gestión de Credenciales**
- Eliminar credenciales por defecto
- Usar contraseñas fuertes y únicas
- Implementar gestión segura de secretos

### 3. **Control de Acceso**
- Implementar autenticación robusta
- Aplicar principio de menor privilegio
- Proteger archivos de configuración

### 4. **Logging Seguro**
- No registrar información sensible
- Implementar logging estructurado
- Proteger archivos de log

### 5. **Protección de Datos**
- Cifrar datos sensibles
- Implementar controles de acceso a datos
- Usar conexiones seguras (HTTPS/SSL)

## 📚 Referencias Educativas

- **OWASP Top 10 2021 - A05 Security Misconfiguration**
- **OWASP Application Security Verification Standard (ASVS)**
- **NIST Cybersecurity Framework**
- **CIS Controls**

## ⚠️ Advertencia Legal

**IMPORTANTE:** Esta aplicación contiene vulnerabilidades intencionalmente implementadas y NO debe ser utilizada en entornos de producción. Su uso está destinado exclusivamente para:

- Educación en seguridad informática
- Entrenamiento en identificación de vulnerabilidades
- Demostraciones académicas
- Pruebas de concepto en entornos controlados

**El uso indebido de esta información para actividades maliciosas está estrictamente prohibido.**

## 👨‍💻 Información del Desarrollador

- **Propósito:** Demostración educativa de vulnerabilidades de configuración
- **Contexto:** Presentación de Seguridad Informática
- **Fecha:** 2024
- **Versión:** 1.0

---

**🔍 Para explorar las vulnerabilidades, comience navegando a `http://localhost:8081` y siga las instrucciones de demostración.**