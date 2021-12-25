# APEVAD **En desarrollo**
Para consulta del código, por favor vea la rama **development**

# Descripción

APEVAD (Aplicación para la Evaluación de Administrativos y Docentes) es una aplicación web que permite a los estudiantes de una institución educativa evaluar el desempeño académico y laboral de los empleados de la institución educativa, mediante el uso de encuestas previamente creadas en la aplicación.

# Características
- Creación de encuestas
- Creación de estudiantes
- Creación de docentes
- Creación de administrativos
- Creación de carreras
- Creación de grupos de alumnos
- Vinculación de docentes con grupos de alumnos
- Subida de fotografías de docentes y administrativos
- Ingreso de encuestas
- Resultados de encuestas

# Tecnologías
- MySQL
- Laravel con Sanctum
- GraphL con [Lighthouse](https://lighthouse-php.com/)
- Angular

# Base de datos
![Database](https://github.com/MiltonMejia/apevad_backend/blob/main/docs/database.png)

# GraphQL Schema
![Schema](https://github.com/MiltonMejia/apevad_backend/blob/main/docs/schema.png)

# Iniciar proyecto
- Crear base de datos 'apevad_backend' en Mysql
- Correr comandos artisan:
  - php artisan key:generate
  - php artisan config:clear
  - php artisan cache:clear
  - php artisan route:clear
  - php artisan view:clear
  - php artisan optimize:clear
  - php artisan optimize
  - php artisan migrate:fresh --seed
- Para ver los datos en GraphQL:
  - Ejecutar: php artisan serve
  - http://127.0.0.1:8000/graphql-playground
