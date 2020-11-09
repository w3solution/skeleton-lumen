
# requirements

PHP 7.2 >
Server version: Apache/2.4.41 (Ubuntu)
MySQL

# steps start project

    OBS: configure database in .env & 
        GEOCODE_GOOGLE_APIKEY=
        GEOCODE_GOOGLE_LANGUAGE=pt-BR ex: en / pt-BR

    composer install
    php artisan migrate

# requests in POSTMAN

    - import file (Voxus.postman_collection.json)

# steps for use ( postman requests )

    - register user in: Login / 02 - Register
    - login user in: Login / 01 - Login

    - register place user in: Localization / 01 - store localization /user

    - get place user in: Place / 01 - get my place




...after

# tests


vendor/bin/phpunit --filter=testGetLocation
vendor/bin/phpunit --filter=testHelathCheck
vendor/bin/phpunit --filter=testUserLogin






