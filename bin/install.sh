#!/bin/bash

ROOT=$(readlink -f "$(dirname $0)/../docker")

cd $ROOT

docker-compose exec php composer install
docker-compose exec php php bin/console doctrine:schema:create
docker-compose exec php php bin/console doctrine:fixtures:load
docker-compose exec php php bin/console asset:install 

cat <<EOM

Instalation complite!
EOM

exit 0
