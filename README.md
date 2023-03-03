## Laravel 9 Crud of Json Data
This is an application for the CRUD of Json Data.
Users creating from a seeder.
Create and update working with token, generated from command line for the specific user.
Token expires after in 5 minutes.
##

## INSTALLATION
### Run the following commands

1. copy .env.example .env (in Windows)
2. cp .env.example .env (in Linux)
3. composer install
4. php artisan key:generate
5. php artisan migrate --seed
6. php artisan optimize:clear

### And for the token generation
1. php artisan generate:token --username=username --password=password
##
