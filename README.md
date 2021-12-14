<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Install Docker & Ngrok

Follow these instructions to allow for a local instance of Laravel: [https://laravel.com/docs/8.x#getting-started-on-macos](https://laravel.com/docs/8.x#getting-started-on-macos)

Laravel instructions include this step: Docker allows you to easily run MySQL and PHP locally without the hassle of installing the dependencies: [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)

Ngrok will allow Twilio to make requests back to your local machine: [https://ngrok.com/download](https://ngrok.com/download)

## Create .env File
`cd twilio-sms-laravel && mv .env.sample .env`

## Install Sail Without PHP Locally 
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

## Run Sail Headless
`sail up -d`

## Install Migration Files
`sail php artisan migrate`
