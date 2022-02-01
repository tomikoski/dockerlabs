# Dockerlabs
Docker things to help

## nginx-client-cert
Test client for simple certificate authentication. Modified version of: https://blog.linoproject.net/tech-tip-deploy-nginx-in-container-with-client-certificate-verification/

Usage:
```
# create certs
./makecerts 

# build
docker build -t nginx-test1 .

# run
docker run -it --rm -p 8000:80 -p 8443:443 nginx-test1

# test1: HTTP 403
curl -v -k https://127.0.0.1:8443 # => 403

# test2: HTTP 200 (and extra header received)
curl -v -k --cert certs/client.crt --key certs/client.key \
https://127.0.0.1:8443
```
