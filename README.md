1. docker-compose up -d
2. docker exec -i 5.7-mysql mysql -u root -proot -e "CREATE DATABASE todo;"
3. docker exec -i 5.7-mysql mysql -u root -proot todo < todo.sql
