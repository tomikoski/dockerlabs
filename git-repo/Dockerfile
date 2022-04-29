FROM debian:buster

RUN apt-get update && apt-get install -y openssh-server git
RUN git config --global init.defaultBranch main
RUN mkdir -p /git/project && cd /git/project && git init --bare
RUN mkdir -p /run/sshd
COPY key.pub /root/.ssh/authorized_keys
COPY sshd_config /etc/ssh/sshd_config
CMD ["/usr/sbin/sshd", "-D"]
