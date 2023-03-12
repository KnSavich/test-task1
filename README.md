# How to install and deploy it?
1. Clone this repo to your local machine.
2. docker-compose build
3. docker-compose up
4. docker exec -it si_php bash
5. composer install
6. php bin/console doctrine:schema:update --force
7. php bin/console init-db
