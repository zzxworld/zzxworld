server {
    listen 80;
    server_name <domain>;

    root <deploy_path>/src/public;
    index index.html index.htm index.php;

    charset utf-8;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass  127.0.0.1:9000;
        fastcgi_index  index.php;
        include  fastcgi.conf;
    }
}
