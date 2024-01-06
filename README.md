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

En nuestro formulario de registro, pondremos el atributo `novalidate``, para que la validación se realice en el servidor

```html
<form action="{{ route('register') }}" method="POST" novalidate>
```

La validación finalmente queda de este modo:
```php
public function store(Request $request)
    {
        //Validation
        $this->validate($request,[
            'name'=>'required|max:30',
            'username'=> 'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6',
        ]);
    }
```

Para que el campo password confirme que ambos password son iguales, laravel nos da una convención que es la de utilizar el name="password_confirmation" en blade. La palabra clave es confirmation.

finalmente aun no podemos utilizar este formulario ya que la migración encargada de crear estas tabla aun no se ha ejecutado y no podrá, por ejemplo, validar el email.

### Migraciones

Son el "control de versiones" de la bbdd, podemos crear el diseño de la bbdd y compartirlo con nuestro equipo de trabajo

Las migraciones se pueden revertir, la documentacion de laravel nos da más detalles acerca de las migraciones

https://laravel.com/docs/10.x/migrations#main-content

El comando mas común, que nos permite correr nuestras migraciones es:
`sail artisan migrate`

Para eliminar la ultima migracion:
`sail artisan migrate:rollback`

Para eliminar las ultimas 5 migraciones:
`sail artisan migrate:rollback --step=5`

**Para nuestro código lo haremos así:**

Para ejecutar nuestras migraciones en la raiz del proyecto
`sail artisan migrate`

Para verificar el estado de la base de datos, podemos ejecutar
`sail mysql -u` 
e ingresar a la línea de comandos de MySQL.
```
show databases;
use <nombrebbdd>;
show tables;
describe users;
```
lo cual muestra el siguiente resultado:
```
+-------------------+-----------------+------+-----+---------+----------------+
| Field             | Type            | Null | Key | Default | Extra          |
+-------------------+-----------------+------+-----+---------+----------------+
| id                | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| name              | varchar(255)    | NO   |     | NULL    |                |
| email             | varchar(255)    | NO   | UNI | NULL    |                |
| email_verified_at | timestamp       | YES  |     | NULL    |                |
| password          | varchar(255)    | NO   |     | NULL    |                |
| remember_token    | varchar(100)    | YES  |     | NULL    |                |
| created_at        | timestamp       | YES  |     | NULL    |                |
| updated_at        | timestamp       | YES  |     | NULL    |                |
+-------------------+-----------------+------+-----+---------+----------------+
```

Si observamos la tabla no contamos con un campo username, por lo cual al enviar el formulario Laravel nos lanzará un error.

Para ello debemos correr la siguiente migración:

`sail artisan make:migration add_username_to_users_table`

**NOTA:** Laravel tiene muchas convenciones en inglés respecto de los nombres que utilizamos en nuestras operaciones por consola. 

Este comando nos creará un archivo en la carpeta `database/migrations` con la siguiente estructura: (Notemos como el archivo apunta hacia la tabla 'users')

```php
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
```

Cuando ejecutamos un rollback se ejecuta down(). Por lo tanto si agregamos campos, en up(), debemos eliminarlos en el down.
El archivo de la nueva migración entonces tiene este aspecto:

```php
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
```

Finalmente ejecutamos: `sail artisan migrate`
