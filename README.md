# Sebstagram
Proyecto formativo que consiste en crear un clon de instagram con Laravel 10.
Este Readme se irá actualizando a medida que avance el proyecto por lo que no es estático. Para observar los cambios se deben ir analizando los commits de este readme asi como de los archivos internos del proyecto.

### Crear un proyecto de laravel

[Instalación de laravel](https://laravel.com/docs/10.x/installation#sail-on-macos)

### Instalando tailwindcss
[Enlace a la documentacion de tailwindcss](https://tailwindcss.com/docs/guides/laravel)

Debemos seguir la documentacion para poder instalar tailwind en Laravel, si utilizamos sail, debemos anteponer la instrucción ```sail``` antes de ```npm```.

```
sail npm install -D tailwindcss postcss autoprefixer
```

Para ejecutar el servidor de desarrollo con hot module replacement, en otra terminal ejecutamos:
```
sail npm run dev
```

En este proyecto se ocupa el helper now, para consultar por mas helpers podemos revisar el siguiente enlace:
[https://laravel.com/docs/10.x/helpers](https://laravel.com/docs/10.x/helpers)

### Artisan

Es el CLI que nos permitira realizar operaciones dentro de laravel.

[https://laravel.com/docs/10.x/artisan](https://laravel.com/docs/10.x/artisan)

Si ponemos en la terminal en la raiz del proyecto ```sail artisan``` podremos ver una lista de todas las operaciones que podremos realizar.
para visualizar la ayuda, por ejemplo, para crear un controlador, podremos escribir: ```sail artisan make:controller --help```

### Creando un controlador

Por convención el nombre del controlador debe tener como sufijo la palabra Controller

```sail artisan make:controller RegisterController```

Para crear nuestro controlador dentro de una carpeta lo haremos de la siguiente forma

```sail artisan make:controller auth\\RegisterController```

Lo que nos creará el archivo RegisterController dentro de la carpeta auth.

### Conectando una vista con el controlador

```php
// web.php
Route::get('/crear-cuenta', [RegisterController::class, 'index']);
```

```php
// RegisterController.php
class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
}
```
### Controllers en laravel
En laravel existen convenciones para nombrar estos métodos. En este sentido, si un método en un controlador muestra una vista entonces este método se debe llamar **index**. 

Los controllers ayudan a tener codigo mejor organizado, ademas de una separación de las responsabilidades de cada funcionalidad.

[https://laravel.com/docs/10.x/controllers](https://laravel.com/docs/10.x/controllers)

### Validaciones en Laravel

laravel cuenta con un robusto sistema de validaciones para los datos que se ingresan en formularios.

[https://laravel.com/docs/10.x/validation](https://laravel.com/docs/10.x/validation)

nosotros podemos poner nuestros mensajes de validacion en blade de la siguiente forma:

```php
@error('name')
    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
        {{ $message }}
    </p>
@enderror
```

pero esto nos entregará el mensaje en inglés. Existen repositorios en github que tienen traducciones para estas validaciones. Uno de ellos es el siguiente repositorio.

https://github.com/MarcoGomesr/laravel-validation-en-espanol

Clonamos el repositorio con la siguiente instruccion:

```git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang```

Abrimos el archivo ```/config/app.php``` y reemplazamos el valor de la variable locale por es.

