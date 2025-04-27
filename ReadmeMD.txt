# Symfony 5.4 - Triangle API

##Opis
This project is simple API built with PHP and Symfony that allows saving triangles into SQLite database, and calculate the total surface area and total circumference of all stored triangles.

---

##Tehnologies used:
- Symfony 5.4
- Doctrine ORM
- SQLite
- PHP 8.x

---

##Installation and setup

```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php -S 127.0.0.1:8000 -t public

##Api endpoints
- save triangle 
   POST http://127.0.0.1:8000/triangle/3/4/5

- get total surface and circumference
   GET /triangles


##Database
The application uses a SQLite database located at: "var/data.db"
 Table name: Triangles
 Fields: id,a,b,c

##Author
Igor Josić

