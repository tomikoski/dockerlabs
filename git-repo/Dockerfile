FROM debian:bullseye-slim

RUN apt-get update && apt-get install -y openssh-server git
RUN git config --global init.defaultBranch main
RUN mkdir -p /git/project && cd /git/project && git init --bare


