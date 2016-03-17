Silex project template
==========


Example nginx vhost config:

```
server {
    listen 80;
    #listen [::]:80 default_server ipv6only=on;

    root /var/www/site/web;
    index index.php index.html index.htm;

    server_name sitename;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php(/.+)?$ {
        root /var/www/site/web;

        fastcgi_pass   127.0.0.1:9000;
        include fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;

    }

    include hhvm.conf;
}
```
