#Dockerfile
FROM arm32v7/debian:buster

RUN apt update
RUN apt install -y build-essential
COPY test.c /
RUN gcc test.c -static -o test-binary
