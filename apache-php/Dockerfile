FROM ubuntu:20.04

RUN apt-get update
# avoid interaction for tz :O
RUN apt-get install -y tzdata
RUN apt-get install -y apache2 php

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]

# run:
# docker run -it --rm -p 8000:80 apache-test2  
