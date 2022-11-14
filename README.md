# ITMed-Task-2
<br>

## Installation
First of all you need to clone the project into your local directory
bash
git clone [https://github.com/Umidjon017/ITMed-Task-2.git]

<br>

Then install [composer](https://getcomposer.org/download/) codes to create the vendor folder
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

php composer-setup.php

php -r "unlink('composer-setup.php');"
```
Then
```bash
composer.phar install
```

<br>

Or just install the [composer](https://getcomposer.org/) program once and it will work always without any installation codes

<br>

## Create a database
<br>

## Run migrations in the console
```bash
php artisan migrate
```
<br>

## Install npm
```bash
npm install
npm run dev
```
## Serve the project
```bash
php artisan serve
```

## Links for api-documentation

administrator role account
```bash
http://localhost:8000/api-docs
```

<br>

# Enjoy from the app!
