docker-compose stop && docker-compose rm --all &&
docker-compose build &&
docker-compose up -d &&
docker ps -a
