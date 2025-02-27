<p align="center"><img width="150px" src="/resources/logo_purple.svg" alt="Logo Daybreak"></p>
<p align="center">
    <a href="https://github.com/eporsche/daybreak/actions">
        <img src="https://github.com/eporsche/daybreak/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/daybreak/daybreak">
        <img src="https://img.shields.io/packagist/dt/daybreak/daybreak" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/daybreak/daybreak">
        <img src="https://img.shields.io/packagist/v/daybreak/daybreak" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/daybreak/daybreak">
        <img src="https://img.shields.io/packagist/l/daybreak/daybreak" alt="License">
    </a>
</p>

## About Daybreak

Daybreak is a very simplistic timesheet and vacation planning program for small businesses. It was created because I needed something I could host myself and integrate better into our local IT enviornment. Other open sourced programs like [smalltime](https://www.small.li/) or [kimai](https://www.kimai.org/) didn't work out for me, since they did not comply to C-55/18 EuGH or where not easily extendable.
This program is inspired by papershift. If you are looking for something more robust and/or more enterprise ready, I suggest you test and use their service at [papershift.com](https://papershift.com).

## Open Todos

- [ ] Documentation
- [x] Add automatic pause times after "x" working hours
- [ ] Include holiday importer for other countries
- [ ] Make timezone of location configurable and make use of it
- [ ] Add more absence times calculators
- [x] Add extended datatables and disable employee switcher
- [ ] More Tests

## Production ready deployment using Docker

```bash
# Clone repository using git & change into cloned directory
git clone https://github.com/eporsche/daybreak.git && cd daybreak

# Copy .env.prod.example to .env.prod and edit it to fit your needs
cp .env.prod.example .env.prod

# Build the app container
docker compose -f docker-compose.prod.yaml build

# Generate an application secret
docker compose -f docker-compose.prod.yaml run --rm app php artisan key:generate

# Apply database schema
docker compose -f docker-compose.prod.yaml run --rm app php artisan migrate --force

# Start the stack (web app will be available on port 8080 by default)
docker compose -f docker-compose.prod.yaml up -d
```
If you plan to run Daybreak publicly, make sure you do so behind a reverse proxy. You can use the `X-Real-IP` and `X-Forwarded-Proto` headers to pass the actual client IP and encryption state to the app container.

If you want to prevent new users from registering themselves, you can do so by disabling the feature after you created your own account. Simply comment out the line `Features::registration(),` at the end of the file `config/fortify.php`. After that, rebuild the app container image and recreate the container. The registration button should now be disabled.

## Installation instruction to setup a development environment

### Requirements

**Ubuntu/Debian**

```bash
apt-get update
apt-get install php7.4 php7.4-common php7.4-bcmath openssl php7.4-json php7.4-mbstring php7.4-xml

```

Install [docker](https://docs.docker.com/get-docker/) and [composer](https://getcomposer.org/download/) on you system.

### Clone repository

```bash
git clone https://github.com/eporsche/daybreak.git && cd daybreak
```

### Setup repository

```bash
# Restore PHP packages
composer install

# Create .env file
# By default port :80 will be used. To change the port, put `APP_PORT=<port>` into the .env config file
cp .env.example .env
```

### Start application

```bash
# Start the application
./vendor/bin/sail up -d

# Generate app key
./vendor/bin/sail artisan key:generate

# Migrate database
./vendor/bin/sail artisan migrate
```

By default, the application is available at: http://localhost

### Mails

In the default installation the sending of mails is simulated with mailhog, you can view them via your browser at http://localhost:8025

## A small video preview of the application

[![preview](https://user-images.githubusercontent.com/3265129/114865186-31517300-9df2-11eb-99f3-0a0d4ef16108.png)](https://user-images.githubusercontent.com/3265129/114863596-34e3fa80-9df0-11eb-9ef1-2e424680a67b.mp4)

## Demo Installation

The application can be tested via heroku.

https://demo-daybreak.herokuapp.com/

User: admin@daybreak.corp

Password: admin1234

Limitation:
- No Emails will be send from the demo instance, therefore user invitations won't work
- Application will be reset to defaults every 24h

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Erik Porsche via [e.porsche@gmail.com](mailto:e.porsche@gmail.com). All security vulnerabilities will be promptly addressed.

## License

Copyright (c) Erik Porsche

Daybreak is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Icons made by [Freepik](https://www.freepik.com) from [www.flaticon.com](https://www.flaticon.com/)
