server {
    listen 80;

    root <deploy_path>/src/public;
    index index.html index.htm index.php;

    server_name <domain>;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        fastcgi_pass  127.0.0.1:9000;
        fastcgi_index  index.php;
        include  fastcgi.conf;
    }
}
