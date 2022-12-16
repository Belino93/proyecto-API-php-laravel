<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proyecto Laravel-PHP

Proyecto realizado para GeeksHubs Academy, se nos pide crear la parte backend para una aplicación web LFG, que permita que los usuarios puedan formar grupos para jugar a videojuegos, en el que tambien pueden utilizarlo como chat.

La relación entre tablas seria la siguiente:
![DDBB-Laravel](https://user-images.githubusercontent.com/90568424/208158757-3b2a7356-9286-4166-92b3-ea286ded1290.PNG)


## Uso de la API

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/23873290-13f4e0cd-5e89-4660-8a4a-2e50c7298333?action=collection%2Ffork&collection-url=entityId%3D23873290-13f4e0cd-5e89-4660-8a4a-2e50c7298333%26entityType%3Dcollection%26workspaceId%3D0036013c-adfd-42cc-995e-7fbd3c9599ba#?env%5BNew%20Environment%5D=W10=)


## Tecnologías utilizadas en el proyecto:
- **Laravel**
- **PHP**

### Librerias extra
    - tymon/jwt-auth : Gestiona la autorización con JWT
    
### Explicación de la estructura del proyecto
Partimos con la estructura básica de laravel.

- **Controllers**
    - AuthController.php : Controlador creado para los endpoints de autenticación.
        - register : Registra un usuario.
        - login : Loguea un usuario.
        - logout : Logout a un usuario, invalida su token.
        - profile : Devuelve el perfil del usuario
        
    - GameController.php : Controlador que contiene los endpoint de la tabla de juegos.
        - getGames : Devuelve todos los juegos de la BD.
        - getGamesByGenre : Devuelve todos los juegos de la BD con un género específico.
        - newGame : Crea un nuevo juego.
        - updateGame : Actualiza un juego.
        - deleteGame : Borra un juego.
    
    - MessageController.php : Controlador que contiene los endpoint relacionados con el chat.
        - getMessageById : Devuelve todos los mensajes de un usuario.
        - newMessage : Crea un mensaje en un grupo.
        - editMessage : Edita un mensaje.
        - deleteMessage : Borra un mensaje.
    
    - PartiesUsersController.php : Controla la creación de grupos con usuarios.
        - joinParty : Maneja la entrada y la salida de un usuario en un grupo.
    
    - PartyController.php : Contiene los endpoints para administrar grupos
        - getParties : Devuelve todas los grupos.
        - getUserParties : Devuelve todos los grupos en los que un usuario está activo.
        - getGameParties : Devuelve todos los grupos que pertenecen a un juego.
        - newParty : Crea un nuevo grupo para un juego de la lista.
        - deleteParty : Borra un grupo, solo si el usuario es el dueño.
        
    - UserController.php : Contiene los endpoints de usuarios
        - getUsers : Devuelve todos los usuarios.
        - updateUser : Actualiza un usuario.
        - deleteUser : Borra un usuario.
        
- **Middlewares**
    - IsSuperAdmin.php : Middleware que controla las peticiones a endpoints para superAdmin.


- **Models**
    - Game.php : Modelo de juego.
    - Message.php : Modelo de Mensaje.
    - Party.php : Modelo de Grupo.
    - Rol.php : Modelo de Rol.
    - User.php : Modelo de Usuario.


- **Explicación de la securización de la API**
    - Los usuarios que no estén logados pueden:
        - Registrarse
        - Loguearse

    - Los usuarios logueados con rol 'user', pueden además:
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
    - Los usuarios que cuenten con el rol de 'superAdmin', pueden también:
        - Crear juegos
        - Eliminar juegos
        - Actualizar juegos
        - Ver todos los usuarios

