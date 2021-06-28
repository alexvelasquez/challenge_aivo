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
cd  challenge_aivo
```

_Ejecutar composer install_
```
php -d memory_limit = -1 composer.phar install
```

_Configurar variables de entorno_
```
  Configurar las credenciales de su base de datos en las variables de entorno .env.dev.local y env.test.local
```

_Crear base de datos y ejecutar migracion para cargar el usuario que cosumirá el servicio_
```
DATABASE DEV
php bin/console --env=dev doctrine:database:create
php bin/console --env=dev doctrine:schema:update --force
php bin/console --env=dev doctrine:migrations:execute 20210627152853

DATABASE TEST
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:update --force
php bin/console --env=test doctrine:migrations:execute 20210627152853
```

_Iniciar ejecución de servidor local_
```
php bin/console serve:run
![image](https://user-images.githubusercontent.com/45674641/123556745-5142d280-d763-11eb-9c72-f42f3633c7db.png)

```

### Consumir servicio 📌

_Obtener token de acceso_
```
Method: POST
Endpoint: api/login_check
Content Type: multipart/form-data
Params: 
  username:ws_aivo
  password:ws_aivo_pass
  
  ![image](https://user-images.githubusercontent.com/45674641/123557011-d5e22080-d764-11eb-979a-4b771a0812b1.png)
  
```
_Funcionamiento de servicio_ 
```
Method:GET
Endpoint: api/youtube
Authorization: Bearer (token generado anteriormente)
Params:
  search(requerido):'john lennon'
  max_results(opcional):2

![image](https://user-images.githubusercontent.com/45674641/123565224-8c102f00-d792-11eb-91c5-4c9a2e19854a.png)

```
_Documentacion y funcionamiento del servicio_

```
Desde /api/doc se podra ver la documentación y probar el servicio de una manera mas interactiva.

![image](https://user-images.githubusercontent.com/45674641/123566623-80266c00-d796-11eb-817c-c36bce58624c.png)

```
### Ejecución de Test Unitarios 📝
```
php ./vendor/bin/phpunit
```

## Autores ✒️
* **Alex Velasquez**
