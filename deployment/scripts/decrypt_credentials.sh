#!/bin/bash

# Please, run this script from root of project

mkdir deployment/decrypted_credentials
openssl aes-256-cbc -K $encrypted_dc0476916c3ad247_key -iv $encrypted_dc0476916c3ad247_iv -in deployment/credentials/id_rsa_deployment.zip.enc -out deployment/decrypted_credentials/id_rsa.zip -d
unzip deployment/decrypted_credentials/id_rsa.zip -d deployment/decrypted_credentials
