# Projecte "Futbol Femení I"

Esta es una mini-aplicación de Laravel para gestionar equipos, estadios, jugadoras y partidos de fútbol femenino.

El proyecto está construido con Laravel, Blade, Vite y Tailwind CSS, y sigue un patrón MVC.

**Característica Principal**: Este proyecto **no utiliza base de datos**. Todos los datos se crean, leen, actualizan y borran almacenándolos directamente en la **sesión** de PHP (`SESSION_DRIVER=file`).

---

## 📋 Requisitos Previos

Para poder ejecutar este proyecto, necesitarás tener instalado en tu máquina:

-   **PHP** (v8.2 o superior)
-   **Composer** (Gestor de dependencias de PHP)
-   **Node.js** (v18 o superior)
-   **npm** (Gestor de paquetes de Node, viene con Node.js)

---

## ⚙️ Instalación (Paso a Paso)

Sigue estas instrucciones en orden para configurar el proyecto correctamente.

### Paso 1: Configurar el Backend (Laravel)

1.  **Clonar o descargar el proyecto:**
    Si tienes git, clona el repositorio. Si no, asegúrate de tener todos los archivos en una carpeta.

2.  **Navegar a la carpeta:**
    Abre una terminal y entra en el directorio del proyecto.

    ```bash
    cd ruta-del-proyecto/futbol-femeni
    ```

3.  **Instalar dependencias de PHP:**
    Composer leerá el archivo `composer.json` e instalará Laravel y todas las librerías necesarias.

    ```bash
    composer install
    ```

4.  **Crear el archivo de entorno:**
    Copia el archivo de ejemplo `.env.example` a un nuevo archivo llamado `.env`. Este archivo guarda tu configuración local.

    ```bash
    cp .env.example .env
    ```

5.  **Generar la clave de la aplicación:**
    Laravel necesita esta clave única para encriptar datos y funcionar de forma segura.

    ```bash
    php artisan key:generate
    ```

6.  **¡IMPORTANTE! Configurar la Sesión:**
    Este es el paso más importante del proyecto. Abre el archivo `.env` que acabas de crear y busca la línea `SESSION_DRIVER`. Asegúrate de que esté configurada como `file`:

    ```env
    SESSION_DRIVER=file
    ```

    _Si dice `database` o cualquier otra cosa, el proyecto no funcionará como se espera, ya que toda la lógica de guardado depende de la sesión de archivos._

### Paso 2: Configurar el Frontend (Vite + Tailwind)

1.  **Instalar dependencias de Node.js:**
    npm leerá el archivo `package.json` e instalará Vite, Tailwind CSS y sus plugins.
    ```bash
    npm install
    ```

---

## 🚀 Ejecutar el Proyecto

Para arrancar la aplicación, necesitarás **dos terminales** abiertas en la carpeta del proyecto.

### Terminal 1: Iniciar Vite

Esta terminal se encarga de compilar el CSS (Tailwind) y el JS, y se mantiene activa vigilando cambios en tus archivos de estilos (`guias.css`) o JS.

````bash
npm run dev

### Terminal 2: Iniciar el Servidor de Laravel

Esta terminal inicia el servidor web de PHP para que puedas ver la aplicación en tu navegador.

```bash
php artisan serve
````
