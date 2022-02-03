FROM ubuntu:20.04

RUN apt-get update
RUN apt-get install -y nginx  

RUN rm -v /etc/nginx/nginx.conf

ADD nginx.conf /etc/nginx/
ADD index.html /var/www/html/
ADD certs/ca.crt /etc/nginx/certs/
ADD certs/client.crt /etc/nginx/certs/
ADD certs/server.crt /etc/nginx/certs/
ADD certs/server.key /etc/nginx/certs/

RUN echo "daemon off;" >> /etc/nginx/nginx.conf
RUN chown -R www-data:www-data /var/lib/nginx

VOLUME ["/etc/nginx/sites-enabled", "/etc/nginx/certs", "/etc/nginx/conf.d", "/var/log/nginx", "/var/www/html"]
EXPOSE 80 443

CMD ["nginx"]

