# 🔐 Presentación: Seguridad de la Configuración

## 📋 Descripción

Este proyecto es una **presentación web interactiva** y una **aplicación de demostración práctica** sobre **Seguridad de la Configuración** (Security Misconfiguration), uno de los fallos de seguridad más comunes y peligrosos en sistemas informáticos según el OWASP Top 10.

**El proyecto incluye:**
- 📖 **Presentación teórica**: Sitio web educativo con contenido completo
- 🧪 **Aplicación práctica**: Sistema con vulnerabilidades intencionalmente implementadas
- 🎯 **Demostraciones en vivo**: Ejemplos reales de configuraciones inseguras

## 🗂️ Estructura del Proyecto

```
Presentacion/
├── index.html              # Página principal de la presentación
├── css/
│   └── styles.css          # Estilos CSS responsivos
├── js/
│   └── script.js           # Funcionalidad JavaScript
├── pages/
│   ├── introduccion.html   # ¿Qué es la Seguridad de la Configuración?
│   ├── causas.html         # ¿Por qué ocurren estos errores?
│   ├── ejemplos.html       # Casos prácticos y reales
│   ├── prevencion.html     # Estrategias de prevención
│   └── conclusion.html     # Reflexiones finales
├── EjemPractico/           # 🧪 APLICACIÓN DE DEMOSTRACIÓN
│   ├── index.php           # Página principal con vulnerabilidades
│   ├── login.php           # Sistema de autenticación inseguro
│   ├── admin.php           # Panel administrativo sin protección
│   ├── config.php          # Configuraciones expuestas públicamente
│   ├── info.php            # Información del sistema (phpinfo)
│   ├── db_connection.php   # Credenciales de BD expuestas
│   ├── sample_data.php     # Datos sensibles sin protección
│   ├── logout.php          # Funcionalidad de cierre de sesión
│   └── database.sql        # Estructura de base de datos
├── Practico/               # Ejercicios adicionales
├── Contenido.txt           # Contenido fuente de la presentación
└── README.md               # Este archivo
```

## 🚀 Inicio Rápido

### 📖 Presentación Web (Estática)

```bash
# Opción 1: Servidor Python
python -m http.server 8000

# Opción 2: Servidor Node.js
npx serve .

# Opción 3: Servidor PHP
php -S localhost:8000
```

**Acceso:** `http://localhost:8000`

### 🧪 Aplicación de Demostración (PHP)

```bash
# Iniciar servidor PHP para EjemPractico
php -S localhost:8081 -t EjemPractico
```

**Acceso:** `http://localhost:8081`

### 🔑 Credenciales de Prueba

| Usuario | Contraseña | Rol | Estado |
|---------|------------|-----|--------|
| admin | admin123 | Administrador | ✅ Activo |
| user | user123 | Usuario | ✅ Activo |
| guest | guest123 | Invitado | ✅ Activo |
| test | test123 | Tester | ❌ Inactivo |
| developer | dev2024! | Desarrollador | ✅ Activo |

## 🎯 Aplicación de Demostración - EjemPractico

### 📱 Páginas y Funcionalidades

#### 🏠 Página Principal (`index.php`)
- **Propósito:** Punto de entrada con información general
- **Vulnerabilidades:**
  - Información del sistema expuesta
  - Configuraciones PHP inseguras
  - Datos sensibles en JavaScript

#### 🔑 Sistema de Login (`login.php`)
- **Propósito:** Autenticación de usuarios
- **Vulnerabilidades:**
  - Credenciales por defecto débiles
  - Contraseñas expuestas públicamente
  - Logging inseguro de credenciales
  - Mensajes de error detallados

#### 👨‍💼 Panel Administrativo (`admin.php`)
- **Propósito:** Gestión administrativa
- **Vulnerabilidades:**
  - Acceso sin autenticación adecuada
  - Exposición de datos financieros
  - Información personal sensible (SSN, cuentas bancarias)
  - Contraseñas de usuarios en texto plano

#### ⚙️ Configuraciones (`config.php`)
- **Propósito:** Configuraciones del sistema
- **Vulnerabilidades:**
  - Archivo de configuración accesible públicamente
  - Credenciales de base de datos expuestas
  - Claves de API y secretos en texto plano
  - Configuraciones PHP inseguras

#### ℹ️ Información del Sistema (`info.php`)
- **Propósito:** Información técnica del servidor
- **Vulnerabilidades:**
  - `phpinfo()` accesible públicamente
  - Variables de entorno expuestas
  - Información del servidor detallada

### 🔓 Cómo Demostrar las Vulnerabilidades

#### 1. Acceso No Autorizado
- Acceder directamente a `admin.php` sin autenticación
- El sistema permite acceso con escalación automática de privilegios

#### 2. Exposición de Credenciales
- Visitar `login.php` para ver todas las credenciales disponibles
- Revisar `config.php` para credenciales de base de datos
- Examinar `sample_data.php` para datos completos

#### 3. Información Sensible Expuesta
- Acceder a `info.php` para ver `phpinfo()`
- Revisar `db_connection.php` para test de conexión
- Examinar la consola del navegador en cualquier página

#### 4. Datos Financieros y Personales
En `admin.php` se pueden ver:
- Salarios de empleados
- Números de Seguridad Social (SSN)
- Cuentas bancarias
- Información financiera completa

### ⚠️ Vulnerabilidades Implementadas

#### 🔴 Críticas

**1. Credenciales por Defecto**
- Usuarios con contraseñas débiles y predecibles
- Credenciales hardcodeadas en código

**2. Exposición de Información Sensible**
- Datos financieros accesibles sin autenticación
- Información personal (SSN, cuentas bancarias)
- Credenciales de base de datos expuestas

**3. Archivos de Configuración Accesibles**
- `config.php` accesible públicamente
- `db_connection.php` con credenciales
- `sample_data.php` con todos los datos

#### 🟡 Altas

**4. Configuraciones PHP Inseguras**
- `display_errors` habilitado en producción
- `allow_url_fopen` habilitado
- Headers de seguridad faltantes

**5. Logging Inseguro**
- Contraseñas registradas en logs
- Información sensible en logs de errores

**6. Falta de Control de Acceso**
- Páginas administrativas sin autenticación
- Escalación automática de privilegios

## 📖 Presentación Web

### ✨ Diseño y UX
- **Responsive Design**: Compatible con dispositivos móviles, tablets y desktop
- **Navegación Intuitiva**: Menú de navegación claro y accesible
- **Animaciones Suaves**: Efectos de transición y animaciones CSS
- **Tipografía Moderna**: Uso de Google Fonts (Inter)
- **Esquema de Colores Profesional**: Gradientes y colores que reflejan seguridad

### 🛠️ Funcionalidades Técnicas
- **Navegación Móvil**: Menú hamburguesa para dispositivos móviles
- **Scroll Suave**: Navegación fluida entre secciones
- **Efectos de Scroll**: Navbar que cambia al hacer scroll
- **Animaciones de Entrada**: Elementos que aparecen al entrar en viewport
- **Accesibilidad**: Navegación por teclado y focus visible

### 📱 Compatibilidad
- **GitHub Pages**: Estructura optimizada para despliegue automático
- **Navegadores Modernos**: Compatible con Chrome, Firefox, Safari, Edge
- **Dispositivos Móviles**: Diseño totalmente responsive
- **SEO Friendly**: Meta tags y estructura semántica

## 📚 Contenido de la Presentación

### 1. Introducción
- Definición de Security Misconfiguration
- Por qué es peligroso
- Contexto en la seguridad moderna

### 2. Causas
- Configuraciones por defecto
- Gestión inadecuada de errores
- Servicios innecesarios activos
- Falta de parches y actualizaciones

### 3. Ejemplos Prácticos
- Contraseñas por defecto
- Permisos incorrectos de archivos
- Configuración incorrecta en la nube
- 2FA deshabilitado

### 4. Prevención
- Proceso de hardening
- Escaneo de vulnerabilidades
- Gestión de parches
- Principio de mínimo privilegio

### 5. Conclusión
- Reflexiones sobre disciplina vs complejidad
- Importancia de la configuración segura
- Llamada a la acción

## 🛡️ Medidas de Mitigación Recomendadas

### 1. Configuración Segura
- Deshabilitar `display_errors` en producción
- Configurar headers de seguridad apropiados
- Usar configuraciones PHP seguras
- Implementar HTTPS/SSL

### 2. Gestión de Credenciales
- Eliminar credenciales por defecto
- Usar contraseñas fuertes y únicas
- Implementar gestión segura de secretos
- Usar variables de entorno para configuraciones

### 3. Control de Acceso
- Implementar autenticación robusta
- Aplicar principio de menor privilegio
- Proteger archivos de configuración
- Usar autorización basada en roles

### 4. Logging Seguro
- No registrar información sensible
- Implementar logging estructurado
- Proteger archivos de log
- Usar sistemas de monitoreo seguros

### 5. Protección de Datos
- Cifrar datos sensibles
- Implementar controles de acceso a datos
- Usar conexiones seguras (HTTPS/SSL)
- Aplicar principios de privacidad por diseño

## 🚀 Despliegue y Uso

### 📖 Presentación Web (GitHub Pages)

1. Subir el proyecto a un repositorio de GitHub
2. Ir a Settings > Pages
3. Seleccionar source: Deploy from a branch
4. Elegir branch: main (o master)
5. Seleccionar folder: / (root)
6. El sitio estará disponible en `https://username.github.io/repository-name`

### 🧪 Aplicación de Demostración (Local)

**Requisitos:**
- PHP 7.4 o superior
- Navegador web moderno

**Pasos:**
1. Clonar o descargar el proyecto
2. Navegar al directorio del proyecto
3. Ejecutar: `php -S localhost:8081 -t EjemPractico`
4. Abrir navegador en `http://localhost:8081`

## 💻 Tecnologías Utilizadas

### 📖 Presentación Web
- **HTML5**: Estructura semántica y accesible
- **CSS3**: Estilos modernos con Flexbox y Grid
- **JavaScript ES6+**: Funcionalidad interactiva
- **Google Fonts**: Tipografía profesional
- **SVG**: Iconos vectoriales escalables

### 🧪 Aplicación de Demostración
- **PHP 8.2+**: Backend y lógica del servidor
- **HTML5**: Estructura de páginas dinámicas
- **CSS3**: Estilos y diseño responsive
- **JavaScript**: Interactividad del lado cliente
- **MySQL**: Estructura de base de datos (simulada)

## 🔧 Mejores Prácticas Implementadas

### 🎨 Frontend
- Código semántico y accesible
- Optimización de rendimiento
- Diseño mobile-first
- Progressive enhancement

### 🔧 Desarrollo
- Separación de responsabilidades (HTML/CSS/JS)
- Código limpio y comentado
- Estructura modular
- Compatibilidad cross-browser

### 🚀 Despliegue
- Optimizado para GitHub Pages
- Sin dependencias externas críticas
- Carga rápida de recursos
- SEO optimizado

## 🎨 Personalización

### Colores
Puedes modificar el esquema de colores editando las variables CSS en `css/styles.css`:

```css
:root {
  --primary-color: #667eea;
  --secondary-color: #764ba2;
  --text-color: #2c3e50;
  --background-color: #f5f7fa;
}
```

### Contenido
Para modificar el contenido, edita los archivos HTML correspondientes en la carpeta `pages/`.

### Estilos
Todos los estilos están centralizados en `css/styles.css` con comentarios explicativos.

## 📚 Referencias Educativas

- **[OWASP Top 10 2021 - A05 Security Misconfiguration](https://owasp.org/Top10/A05_2021-Security_Misconfiguration/)**
- **[OWASP Application Security Verification Standard (ASVS)](https://owasp.org/www-project-application-security-verification-standard/)**
- **[NIST Cybersecurity Framework](https://www.nist.gov/cyberframework)**
- **[CIS Controls](https://www.cisecurity.org/controls)**
- **[SANS Top 25 Software Errors](https://www.sans.org/top25-software-errors/)**

## ⚠️ Advertencia Legal

**IMPORTANTE:** La aplicación EjemPractico contiene vulnerabilidades intencionalmente implementadas y **NO debe ser utilizada en entornos de producción**. Su uso está destinado exclusivamente para:

- ✅ Educación en seguridad informática
- ✅ Entrenamiento en identificación de vulnerabilidades
- ✅ Demostraciones académicas
- ✅ Pruebas de concepto en entornos controlados

**❌ El uso indebido de esta información para actividades maliciosas está estrictamente prohibido.**

## 📄 Licencia

Este proyecto es de uso educativo. Siéntete libre de usar, modificar y distribuir el código para fines académicos y educativos.

## 👨‍💻 Información del Desarrollador

- **Propósito:** Presentación educativa sobre Security Misconfiguration
- **Contexto:** Curso de Seguridad Informática
- **Fecha:** 2024
- **Versión:** 2.0 (Unificada)

## 🎯 Próximos Pasos

1. **Explorar la presentación web** en `http://localhost:8000`
2. **Probar la aplicación vulnerable** en `http://localhost:8081`
3. **Identificar las vulnerabilidades** usando las credenciales proporcionadas
4. **Aplicar las medidas de mitigación** recomendadas
5. **Compartir conocimientos** sobre configuración segura

---

**🔍 Para comenzar, inicia ambos servidores y explora tanto la teoría como la práctica de las vulnerabilidades de configuración de seguridad.**