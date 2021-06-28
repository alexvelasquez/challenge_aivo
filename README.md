# CHALLENGE AIVO
API REST privada que brinda un servicio de busqueda de videos en Youtube

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Deployment** para conocer como desplegar el proyecto.


### Información 📋


```
PHP >= 7.1.3
SYMFONY 4.4
MYSQL
```

### Instalación 🔧
_Clonar_
```
git clone https://github.com/alexvelasquez/challenge_aivo.git
cd challenge_aivo
```

_Ejecutar composer install_
```
php composer.phar install
```
_Crear claves publicas y privadas JWT_
```
mkdir config\jwt,
openssl genrsa -out config/jwt/private.pem 4096,
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

_Configurar variables de entorno y creendiciales de base de datos_
```
 cp .env.dev .env.dev.local
 cp .env.dev .env.test.local
 configurar las credenciales de su base de datos en las variables de entorno .env.dev.local y env.test.local
```

_Crear base de datos y ejecutar migracion para cargar el usuario que cosumirá el servicio_
```
DATABASE DEV
php bin/console --env=dev doctrine:database:create
php bin/console --env=dev doctrine:schema:update --force
php bin/console --env=dev doctrine:migrations:execute DoctrineMigrations\Version20210628025550

DATABASE TEST
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:update --force
php bin/console --env=test doctrine:migrations:execute DoctrineMigrations\Version20210628025550
```

_Iniciar ejecución de servidor local_
```
php bin/console serve:run
```
![image](https://user-images.githubusercontent.com/45674641/123570560-d8fa0280-d79e-11eb-9f77-f901953691fd.png)

### Consumir servicio 📌

_Obtener token de acceso_
```
Method: POST
Endpoint: api/login_check
Content Type: multipart/form-data
Params: 
  username:ws_aivo
  password:ws_aivo_pass
```
![image](https://user-images.githubusercontent.com/45674641/123557011-d5e22080-d764-11eb-979a-4b771a0812b1.png)
_Funcionamiento de servicio_ 
```
Method:GET
Endpoint: api/youtube
Authorization: Bearer (token generado anteriormente)
Params:
  search(requerido):'aivo'
  max_results(opcional):2
```
![image](https://user-images.githubusercontent.com/45674641/123639104-41280300-d7f6-11eb-95da-ddc3978c4b96.png)

_Documentacion y funcionamiento del servicio_

```
Desde /api/doc se podra ver la documentación y probar el servicio de una manera mas interactiva.
```
![image](https://user-images.githubusercontent.com/45674641/123569547-e31b0180-d79c-11eb-9d49-7a34f7f14daa.png)

### Ejecución de Test Unitarios 📝
```
php ./vendor/bin/phpunit
```

## Autores ✒️
* **Alex Velasquez**
