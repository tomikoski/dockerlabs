#!/bin/bash

OUTPUT="./certs"

if ! [[ -d "$OUTPUT" ]]
then
	mkdir $OUTPUT
fi

cd $OUTPUT

openssl genrsa -out ca.key 4096
openssl req -new -x509 -key ca.key -days 365 -sha256 -subj "/C=FI/L=Helsinki/O=PWN/CN=ca" -out ca.crt

openssl genrsa -out server.key 4096
openssl req -subj "/C=FI/L=Helsinki/O=PWN/OU=SERVERS/CN=server" -sha256 -new -key server.key -out server.csr
echo "subjectAltName = DNS:server.adhoc" > serverext.cnf
openssl x509 -req -days 365 -sha256 -in server.csr -CA ca.crt -CAkey ca.key -CAcreateserial -out server.crt -extfile serverext.cnf

openssl genrsa -out client.key 4096
openssl req -subj "/CN=client" -new -key client.key -out client.csr
echo "extendedKeyUsage = clientAuth" > clientext.cnf
openssl x509 -req -days 365 -sha256 -in client.csr -CA ca.crt -CAkey ca.key -CAcreateserial -out client.crt -extfile clientext.cnf

cd ..
