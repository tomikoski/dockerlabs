##git-repo 
Empty git-repo with SSH

### usage
ssh-keygen -t ecdsa -b 521 -f key
docker build . -t git1 && docker run -d -it -p 19999:19999 -p 10022:22 git1
ssh -i key -p 10022 root@localhost
