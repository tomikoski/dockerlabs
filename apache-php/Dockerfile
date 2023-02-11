FROM ubuntu:20.04

RUN apt-get update
# avoid interaction for tz :O
RUN apt-get install -y tzdata
RUN apt-get install -y apache2 php

ADD test.php /var/www/html/

# print simulated file
ADD webService.php /var/www/html/
# printer path
RUN mkdir -p /xpaths/nc_log/

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]

# run:
# docker run -it --rm -p 8000:80 apache-test2  
