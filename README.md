## Instrucciones de Configuración

1. **Crear el archivo `.env`**:  
   Copia el archivo `.env.example` a `.env` y configura las variables de entorno (por ejemplo, conexión a la base de datos, clave de la aplicación, etc.).

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

2. **Ejecutar migraciones y seeders**:  
   Usa el siguiente comando para ejecutar todas las migraciones y poblar la base de datos al mismo tiempo:

    ```bash
    php artisan migrate --seed
    ```

3. **Iniciar el servidor de desarrollo**:  
   Ejecuta el servidor de desarrollo de Laravel para iniciar la aplicación:
    ```bash
    php artisan serve
    ```

# Diseño y Decisiones Técnicas

Este proyecto sigue una arquitectura basada en **API RESTful**, diseñada para ser escalable, mantenible y fácil de extender. A continuación, se describen las principales decisiones técnicas:

## Arquitectura

-   **Modularidad**: El código está organizado en módulos para separar responsabilidades y facilitar el mantenimiento.
-   **Controladores y Servicios**: Los controladores manejan las solicitudes HTTP, mientras que la lógica de negocio se delega a los servicios.
-   **Repositorios**: Se utiliza un patrón de repositorio para interactuar con la base de datos, lo que permite desacoplar la lógica de acceso a datos.
-   **Interfaces**: Las interfaces definen contratos claros entre las capas, facilitando la implementación y pruebas.
-   **Traits**: Se utilizan Traits para encapsular funcionalidades reutilizables y reducir la duplicación de código.
-   **Requests**: Las clases de Request se utilizan para validar y sanitizar los datos de entrada, asegurando que las solicitudes sean consistentes y seguras.
-   **Base de Datos**: Se utiliza **MySQL** como sistema de gestión de bases de datos, aprovechando su robustez y soporte para transacciones complejas.
-   **ORM**: Se utiliza **Eloquent** como ORM para simplificar las operaciones con la base de datos y manejar relaciones como "muchos a muchos".
-   **Autenticación**: Laravel Sanctum se utiliza para gestionar la autenticación basada en tokens, proporcionando seguridad y facilidad de uso.

## Relaciones y Transacciones

-   **Relaciones**: Se implementó una relación de "muchos a muchos" entre las tablas principales mediante una tabla intermedia llamada `sale_details`. Esta tabla almacena información detallada sobre cada venta, como productos y cantidades.
-   **Transacciones**: Para registrar una venta, se utiliza Eloquent junto con transacciones de base de datos. Esto asegura que:
    1. Se cree un registro en la tabla `sales`.
    2. Se inserten los detalles de la venta en la tabla `sale_details`.
    3. Si ocurre algún error durante el proceso, todos los cambios se revierten automáticamente para mantener la consistencia de los datos.

## Estructura de Carpetas

El proyecto sigue una estructura organizada para facilitar el mantenimiento y la escalabilidad:

-   **Controllers**: Manejan las solicitudes HTTP y delegan la lógica de negocio a los servicios.
-   **Services**: Contienen la lógica de negocio principal, separada de los controladores.
-   **Repositories**: Gestionan el acceso a la base de datos utilizando Eloquent.
-   **Interfaces**: Definen contratos para los repositorios, asegurando que las implementaciones sean consistentes.
-   **Traits**: Encapsulan funcionalidades reutilizables, como manejo de respuestas o lógica común.
-   **Requests**: Validan y procesan los datos de entrada antes de que lleguen a los controladores.

## Decisiones Técnicas

1. **Framework**: Se eligió Laravel por su robustez, comunidad activa y herramientas integradas como Eloquent y Sanctum.
2. **Autenticación**: Laravel Sanctum se utiliza para gestionar la autenticación basada en tokens.
3. **Validación**: Las clases de Request se utilizan para validar los datos de entrada de manera centralizada.
4. **Manejo de Errores**: Se implementó un manejo uniforme de errores utilizando Traits y excepciones personalizadas.

## Retos Técnicos

1. **Gestión de Transacciones**: Implementar transacciones con Eloquent para garantizar la consistencia de los datos fue un desafío, especialmente al manejar múltiples tablas relacionadas.
2. **Optimización de Consultas**: Diseñar consultas eficientes para manejar grandes volúmenes de datos en `sale_details` sin afectar el rendimiento.
3. **Relaciones Complejas**: Configurar correctamente las relaciones "muchos a muchos" en Eloquent, asegurando que las claves foráneas y las restricciones sean consistentes.
