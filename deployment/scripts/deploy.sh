#!/bin/bash

# Please, run this script from root of project

# 1. Install deployer

chmod +x deployment/scripts/install_deployer.sh && deployment/scripts/install_deployer.sh

# 2. Decode credentials

chmod +x deployment/scripts/decrypt_credentials.sh && deployment/scripts/decrypt_credentials.sh

# 3. Install front

chmod +x deployment/scripts/install_front.sh && deployment/scripts/install_front.sh

# 4. Move decoded private key to ssh directory and configure ssh

#mkdir ~/.ssh
#cp deployment/decrypted_credentials/id_rsa_tastymade_deploy ~/.ssh/id_rsa_deploy
# touch ~/.ssh/config
# echo "Host dev.tastymade.ru" >> ~/.ssh/config
# echo "    IdentityFile ~/.ssh/id_rsa_tastymade_pk" >> ~/.ssh/config

# 5. Define environment by branch


DEPLOY_ENV=""

case "$CIRCLE_BRANCH" in
#    feature*)
#        DEPLOY_ENV="feature"
#        ;;
#    staging)
#        DEPLOY_ENV="staging"
#        ;;
    master)
        DEPLOY_ENV="production"
        ;;
    *)
        DEPLOY_ENV="develop"
        ;;
esac

# 5. Run deployer

if [ -z "$DEPLOY_ENV" ]
then
    echo "Deploy environment if not defined!"
else
    dep deploy ${DEPLOY_ENV}
fi
