# Symfony 5.4 - Triangle API

##Opis
Aplikacija napravljena u Symfony 5.4 koja omogućava spremanje trouglova u SQLite bazu i izračun ukupne površine i obime svih zapisa.

---

##Tehnologije
- Symfony 5.4
- Doctrine ORM
- SQLite
- PHP 8.x

---

##Pokretanje projekta

```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php -S 127.0.0.1:8000 -t public
