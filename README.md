# Lumen rest api json
Php lumen rest api app example.

### Install
```bash
git clone https://github.com/wowpowhub/lumen.git /var/www/html/lumex.xx

chown -R your-user-name:www-data /var/www/html/lumex.xx
chmod -R 2775 /var/www/html/lumex.xx

cd /var/www/html/lumex.xx
composer update --no-dev
composer dump-autoload -o --no-dev
```

### Run in browser
```
php -S localhost:8000 -t /var/www/html/lumex.xx/public
```

### Local host domain
nano /etc/hosts
```
# Add line
127.0.0.1 www.lumex.xx lumex.xx
```

### Run with Nginx virtualhost
nano /etc/nginx/sites-available/default
```
# Add to file
# /etc/nginx/sites-available/default

server {
    listen 80;
    listen [::]:80;
    server_name lumex.xx;
    root /var/www/html/lumex.xx/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?url=$uri&$args;
    }

    location ~ \.php$ {
        # don't cache it
        proxy_no_cache 1;
        proxy_cache_bypass 1;
        expires -1;

        # Php-fpm
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    }

    disable_symlinks off;
    client_max_body_size 100M;

    # Tls redirect
    # return 301 https://$host$request_uri;
    # return 301 https://lumex.xx$request_uri;
}
```

### Mysql database
```sh
# import database
mysql -u root -p < /var/www/html/lumex.xx/api_app.sql
```

### Lumen start session
nano bootstrap/app.php
```php
<?php
// Session lifetime seconds
$lifetime = 60 * 120;

// Session lifetimes
ini_set('session.gc_maxlifetime', $lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

// Session cookie (change secure to true in production for https)
session_set_cookie_params([
    'lifetime' => $lifetime,
    'path' => '/',
    'domain' => '.'.$_SERVER["HTTP_HOST"],
    'secure' => isset($_SERVER["HTTPS"]),
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Run php session
session_start();
```

### Authenticate user
nano App/Models/User.php
```php
/**
 * If user authenticated
 *
 * @return mixed User object or null
 */
static public function auth($token)
{
    // Validate user token here in database or session
    if($token == 'token123')
    {
        // User object or null
        // return new self();

        // Logged user object or null
        $user = new User();
        $user->name = 'Hi.iH';
        $user->email = 'hi@example.com';
        $user->role = 'worker';
        return $user;
    }

    // Error
    return null;
}
```

### Authenticate service
nano App/Providers/AuthServiceProvider.php
```php
<?php
namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        /* Custom Authorization */

        $this->app['auth']->viaRequest('api', function ($request) {

            // Get user token
            $token = $request->header('Authorization');

            // Clean bearer token
            $token = str_ireplace('Bearer ', '', $token);

            // Validate token in User Controller (return user object or null)
            return User::auth($token);

        });
    }
}
```

### Authentication curl
```sh
# get
curl -H 'Authorization: token123' http://lumex.xx/auth

# POST register user
curl -X POST -d 'email=cool@woo.xx&pass=password' http://lumex.xx/register

# POST login user
curl -X POST -d 'email=worker@woo.xx&password=password' http://lumex.xx/login

# POST valid auth
curl -X POST -d 'name=HELLO&pass=password' -H 'Authorization: Bearer token123' http://lumex.xx/panel
curl -X POST -d 'name=HELLO&pass=password' -H 'Authorization: Bearer token123' http://lumex.xx/panel/777

# POST invalid auth
curl -X POST -d 'name=HELLO&pass=password' -H 'Authorization: Bearer token12' http://lumex.xx/panel
curl -X POST -d 'name=HELLO&pass=password' -H 'Authorization: Bearer token12' http://lumex.xx/panel/888
```

### Lumen api token authentication
https://www.youtube.com/watch?v=Plh5wiISHTU

### Lumen api session
https://github.com/rummykhan/lumen-session-example
