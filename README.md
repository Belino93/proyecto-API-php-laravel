<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proyecto Laravel-PHP

Proyecto realizado para GeeksHubs Academy, se nos pide crear la parte backend para una aplicación web LFG, que permita que los usuarios puedan formar grupos para jugar a videojuegos, en el que tambien pueden utilizarlo como chat.

## Uso de la API

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/23873290-13f4e0cd-5e89-4660-8a4a-2e50c7298333?action=collection%2Ffork&collection-url=entityId%3D23873290-13f4e0cd-5e89-4660-8a4a-2e50c7298333%26entityType%3Dcollection%26workspaceId%3D0036013c-adfd-42cc-995e-7fbd3c9599ba#?env%5BNew%20Environment%5D=W10=)


## Tecnologías utilizadas en el proyecto:
- **Laravel**
- **PHP**

### Librerias extra
    - tymon/jwt-auth : Gestiona la autorización con JWT
    
### Explicación de la estructura del proyecto
Partimos con la estructura basica de laravel.

- **Controllers**
    -AuthController.php : Controlador creado para los endpoints de Registro, Login y Perfil.
    -GameController.php : Controlador que contiene los endpoint de la tabla de juegos.
    -MessageController.php : Controlador que contiene los endpoint relacionados con el chat.
    -PartiesUsersController.php : Controla la creacion de grupos con usuarios.
    -PartyController.php : Contiene los endpoints para administrar grupos.
    -UserController.php : Contiene los endpoints de usuarios

- **Middleewares**
    -IsSuperAdmin.php : Middleware que controla las peticiones a endpoints para superAdmin.


- **Models**
    -Game.php : Modelo de juego.
    -Message.php : Modelo de Mensaje.
    -Party.php : Modelo de Grupo.
    -Rol.php : Modelo de Rol.
    -User.php : Modelo de Usuario.


- **Explicación de la securización de la API**
    -Los usuarios que no estén logados pueden:
        - Registrarse
        - Loguearse

    -Los usuarios logueados con rol 'user', pueden además:
        - Ver juegos
        - Buscar juegos
        - Crear grupos
        - Buscar grupos
        - Unirse a grupos de juego
        - Enviar mensajes
        - Ver sus mensajes
        - Editar sus mensajes
        - Borrar mensajes
        - Ver su perfil
        - Borrar su perfil
    -Los usuarios que cuenten con el rol de 'superAdmin', pueden también:
        - Crear juegos
        - Eliminar juegos
        - Actualizar juegos
        - Ver todos los usuarios

