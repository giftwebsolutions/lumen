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