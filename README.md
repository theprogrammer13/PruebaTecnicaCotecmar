# Sistema de Gestión de Piezas

## Requerimiento Inicial

El objetivo de este proyecto es desarrollar una aplicación web para visualizar y gestionar el listado de piezas registradas. La solución implementa:

    *Autenticación de usuarios: Con validación de credenciales y protección de rutas.

    *Formulario dinámico: Para registro y actualización de piezas con relaciones entre proyectos, bloques y piezas.

    *Cálculos automáticos: Diferencia entre peso teórico y real.

    *Responsive design: Adaptable a diferentes dispositivos.

    *Reportes: Visualización de piezas pendientes agrupadas por proyectos.

## Requisitos del Sistema
# Versiones de PHP soportadas por Laravel 10

Laravel 10 requiere PHP 8.1 o superior. Se recomienda utilizar una de las siguientes versiones:

    *PHP 8.1 (mínimo requerido)

    *PHP 8.2 (recomendado para mejor rendimiento)

    *PHP 8.3 (última versión estable)

Versiones no soportadas:

    *PHP 7.x o inferior

    *PHP 8.0 (soporte terminado)

Complementos:

    *Composer 2.2+

    *Git

Extensiones PHP requeridas:

    *BCMath

    *Ctype

    *cURL

    *DOM

    *Fileinfo

    *JSON

    *Mbstring

    *OpenSSL

    *PCRE

    *PDO

    *Tokenizer

    *XML

    *SQLite3 (si usa SQLite)

## Requerimientos de Frontend

Node.js:

    *Versión mínima: Node.js 16.x

    *Versión recomendada: Node.js 18.x LTS o superior

    *npm: 8.x o superior (o yarn 1.22+)

Dependencias JavaScript:

    *Vue 3.2+

    *@inertiajs/vue3 1.0+

    *@vitejs/plugin-vue 3.0+

    *laravel-vite-plugin 0.7+

Dependencias CSS:

    *tailwindcss 3.* o 4.* (cli o cdn)
o:

    *Bootstrap 4.* o 5.* (cli o cdn)

## Instrucciones de Instalación

### 1. Instrucciones para Clonar el Repositorio Git
Requisitos previos:

    *Tener Git instalado (Descargar Git)

    *Tener una cuenta en GitHub (opcional, pero recomendado para hacer fork)

Pasos para clonar el repositorio:

Abrir terminal o línea de comandos:

    *Windows: Git Bash, CMD o PowerShell

    *Linux/macOS: Terminal

Navegar al directorio donde quieres clonar el proyecto:

```
    cd ruta/donde/guardar/proyecto
```

Ejecutar el comando de clonación:

```
    git clone https://github.com/theprogrammer13/PruebaTecnicaCotecmar.git
```

Acceder al directorio del proyecto:

```
    cd PruebaTecnicaCotecmar
```


### 2. Instalación de Dependencias

Ejecute los siguientes comandos en la raíz del proyecto, esta es la configuración inicial del proyecto después de clonar (instala las dependencias de Laravel y las que usa Vue, se actualiza composer.json y package.json respectivamente):

```
    composer install
    npm install
```

Copiar el archivo de entorno:

```
    cp .env.example .env
```

Generar clave de aplicación:

```
    php artisan key:generate
```

### 3. Configuración de la Base de Datos

El proyecto utiliza SQLite por defecto. Para configurarla:

```
    touch database/database.sqlite
```

Luego, configure el archivo .env:

```
    DB_CONNECTION=sqlite
    #DB_DATABASE=/absolute/path/to/database.sqlite (opcional para windows, hay que colocar la dirección absoluta del archivo para que funcione)
```

### 4. Migraciones y Datos Iniciales

Ejecute las migraciones y seeders para poblar la base de datos. (Se puede crear directamente la base de datos con este comando):

```
php artisan migrate --seed
```

### 5. Compilación de Assets

Para compilar los assets de Vue.js:

```
    npm run dev
```
O para producción:

```
    npm run build
```

### 5. Ejecución del Servidor

Inicie el servidor de desarrollo:

```
    php artisan serve
```

## Estructura de la Base de Datos

El sistema utiliza las siguientes tablas principales:

    *users: Almacena los usuarios autorizados (Luis, Gabriel, Sergio)

    *projects: Contiene los proyectos (BICM, BALC, OPV, BRF)

    *blocks: Almacena los bloques asociados a proyectos

    *parts: Registra todas las piezas con sus pesos y estados

## Credenciales de Acceso

Se incluyen tres usuarios por defecto:

```
Usuario	Contraseña
Luis	0000
Gabriel	1111
Sergio	2222
```
### Funcionalidades Principales
    
    *Formulario de Piezas

    *Selección jerárquica Proyecto → Bloque → Pieza

    *Carga automática de peso teórico

    *Cálculo de diferencia entre peso teórico y real

    *Validación en cliente de campos obligatorios

    *Persistencia de datos en validaciones fallidas

### Reportes

    *Listado de piezas pendientes agrupadas por proyecto

    *Gráficos de piezas pendientes vs. fabricadas

## Comandos Útiles

Para limpiar cachés y optimizar:

Podría existir problemas menores que tienen que ver con la cache en la configuración, el ruteo de la aplicación o simplemente la optimización de paqueteria, entre otros y para eso se debe usar estos comandos:

``` 
    composer dump-autoload &&
    php artisan cache:clear &&
    php artisan config:clear &&
    php artisan config:cache &&
    php artisan route:clear &&
    php artisan route:cache &&
    php artisan view:clear && 
    php artisan view:cache &&
    php artisan optimize:clear
```

## Configuración Adicional

Si prefiere usar MySQL en lugar de SQLite, modifique el archivo .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minucia
DB_USERNAME=root
DB_PASSWORD=
```

## Notas Importantes

    *El sistema está desarrollado con Laravel 10, Vue.js 3 e Inertia.js

    *Se utiliza Eloquent ORM para todas las operaciones con la base de datos

    *El frontend está construido con componentes Vue reutilizables

    *La aplicación es completamente responsive

Para cualquier problema durante la instalación, verifique los permisos de archivos y la configuración de su entorno PHP.