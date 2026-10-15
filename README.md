
# 🏦 Banco Senati — Sistema Bancario MVC

Sistema de gestión bancaria desarrollado en **PHP 8** con arquitectura **MVC**, **PDO** y **Composer**. Interfaz moderna con **Bootstrap 5**, animaciones dinámicas y reportes PDF.

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-2.x-885630?logo=composer&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green)

---

## ✨ Características

- 🔐 **Autenticación segura** con `password_hash()` + `password_verify()`
- 🛡️ **Protección CSRF** en todos los formularios
- 💉 **Cero inyección SQL** — 100% consultas preparadas (PDO)
- 👥 **CRUD de clientes** con saldo calculado en tiempo real
- 💰 **Gestión de depósitos** con validación de montos
- 💸 **Retiros** con verificación de saldo disponible
- 🧾 **Pago de servicios** (agua, luz, teléfono, etc.)
- 👤 **Gestión de usuarios** con roles (admin, empleado, obrero)
- 📊 **Reportes PDF** con Dompdf
- 🎨 **UI moderna** con glassmorphism, gradientes y modo oscuro
- ⚡ **Animaciones fluidas** con AOS y Chart.js
- 📱 **Diseño responsive** con Bootstrap 5.3
- 🍞 **Notificaciones toast** con SweetAlert2
- 📈 **Dashboard con gráficos dinámicos**

---

## 🚀 Instalación

### Requisitos previos

- PHP 8.1 o superior
- MySQL 5.7+ / MariaDB 10+
- Composer 2.x
- Extensión `pdo_mysql` activa

### Pasos

```bash
# 1. Clonar repositorio
git clone https://github.com/tu-usuario/banco-senati.git
cd banco-senati

# 2. Instalar dependencias
composer install

# 3. Configurar variables de entorno
cp .env.example .env
# Edita .env con tus credenciales de MySQL

# 4. Crear base de datos
mysql -u root -p < database/banco_senati.sql

# 5. Levantar servidor de desarrollo
php -S localhost:8000 -t public
```

Abre **http://localhost:8000** en tu navegador.

---

## 🔐 Credenciales por defecto

| Usuario   | Contraseña  | Rol           |
| --------- | ------------ | ------------- |
| `admin` | `admin123` | Administrador |

> ⚠️ **Importante**: cambia la contraseña del administrador en producción.

---

## 📁 Estructura del proyecto

```
banco_senati/
├── app/
│   ├── Config/              # Conexión PDO singleton
│   │   └── Database.php
│   ├── Controllers/         # Controladores MVC
│   │   ├── AuthController.php
│   │   ├── ClienteController.php
│   │   ├── DepositoController.php
│   │   ├── RetiroController.php
│   │   ├── PagoServicioController.php
│   │   ├── UsuarioController.php
│   │   └── ReporteController.php
│   ├── Core/                # Núcleo del framework
│   │   ├── Controller.php
│   │   ├── Model.php
│   │   ├── Router.php
│   │   ├── Session.php
│   │   ├── Csrf.php
│   │   └── Validator.php
│   ├── Models/              # Modelos de BD
│   │   ├── Cliente.php
│   │   ├── Deposito.php
│   │   ├── Retiro.php
│   │   ├── PagoServicio.php
│   │   └── Usuario.php
│   └── Views/               # Vistas con Bootstrap
│       ├── layouts/
│       ├── auth/
│       ├── dashboard/
│       ├── clientes/
│       ├── depositos/
│       ├── retiros/
│       ├── pagos/
│       └── usuarios/
├── config/
│   └── database.php         # Config de BD desde .env
├── database/
│   └── banco_senati.sql     # Esquema + datos semilla
├── public/                  # Único directorio expuesto
│   ├── index.php            # Front controller
│   └── .htaccess            # URL rewriting
├── storage/                 # Logs y cache
├── vendor/                  # Dependencias de Composer
├── .env.example
├── .gitignore
├── composer.json
└── README.md
```

---

## 🛠️ Stack tecnológico

| Capa                    | Tecnología                |
| ----------------------- | -------------------------- |
| **Backend**       | PHP 8.1+                   |
| **Base de datos** | MySQL 8 / MariaDB 10       |
| **ORM/DB**        | PDO (consultas preparadas) |
| **Autoload**      | Composer (PSR-4)           |
| **Enrutamiento**  | Router personalizado       |
| **Frontend**      | Bootstrap 5.3              |
| **Iconos**        | Bootstrap Icons            |
| **Gráficos**     | Chart.js 4                 |
| **Animaciones**   | AOS 2.3                    |
| **Alertas**       | SweetAlert2                |
| **PDF**           | Dompdf 3.x                 |
| **Entorno**       | vlucas/phpdotenv           |

---

## 🔐 Seguridad implementada

- ✅ **Hash de contraseñas** con Bcrypt (`password_hash`)
- ✅ **Tokens CSRF** en todos los formularios POST
- ✅ **Consultas preparadas** con PDO (cero SQL injection)
- ✅ **Escape de salida HTML** con `htmlspecialchars()`
- ✅ **Cookies seguras** con `HttpOnly` y `SameSite`
- ✅ **Validación de datos** en servidor
- ✅ **Sesiones** con timeout

---

## 📊 Funcionalidades por módulo

### 👥 Clientes

- Registrar, listar y eliminar clientes
- Cálculo automático de saldo: `depósitos - retiros - pagos`
- Validación de DNI (8 dígitos) y número de cuenta único

### 💰 Depósitos

- Registrar depósitos a cualquier cuenta
- Validación de monto mayor a 0
- Historial con nombre del cliente

### 💸 Retiros

- Validación de **saldo suficiente** antes de retirar
- Mensaje de error si el monto excede el saldo
- Historial completo

### 🧾 Pago de Servicios

- Registro con concepto (agua, luz, teléfono...)
- Misma validación de saldo que retiros
- Filtrado por cliente

### 👤 Usuarios

- CRUD con roles (admin, empleado, obrero)
- Contraseñas cifradas con Bcrypt
- Estado activo/inactivo

### 📊 Reportes PDF

- Exportación individual por módulo
- Formato profesional con Dompdf
- Descarga directa desde el dashboard

---

## 🎨 Capturas de pantalla

> Agrega aquí tus capturas de pantalla en una carpeta `docs/` y referéncialas:

```markdown
![Dashboard](docs/dashboard.png)
![Login](docs/login.png)
![Clientes](docs/clientes.png)
```

---

## 🧪 Pruebas manuales

```bash
# Verificar login
curl -X POST http://localhost:8000/login -d "usuario=admin&password=admin123"

# Ver dashboard (requiere sesión)
curl http://localhost:8000/dashboard
```

---

## 📄 Licencia

Este proyecto está bajo la licencia **MIT**. Ver el archivo [LICENSE](LICENSE) para más detalles.

---

## 👨‍💻 Autor

**David Huaman**

- GitHub: [@tu-usuario](https://github.com/tu-usuario)
- LinkedIn: [tu-perfil](https://linkedin.com/in/tu-perfil)
- Email: tu-email@ejemplo.com

---

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Para cambios importantes:

1. Fork el proyecto
2. Crea tu rama (`git checkout -b feature/NuevaFuncionalidad`)
3. Commit tus cambios (`git commit -m 'Agrega nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/NuevaFuncionalidad`)
5. Abre un Pull Request

---

## ⭐ ¿Te gustó el proyecto?

Dale una estrella ⭐ si te sirvió como referencia para aprender MVC en PHP.
