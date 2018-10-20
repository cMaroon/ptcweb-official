# Setting up your development environment

There are a few different options to get started:

### Install prerequisites
- MySQL 5.7
- PHP 7.1+ (with curl, gd, intl, json, mbstring, mcrypt, mysql, xml and zip extensions)
- a modern version of nodejs (and npm)

### Clone the git repository
    $ git clone https://github.com/cMaroon/ptcweb-official.git

### Configure .env file
```bash
# copy the example file and edit the settings
$ cp .env.example .env
```

### Install Packages
```bash
$ composer install
$ npm install
$ php artisan key:generate
$ php artisan migrate:fresh
$ php artisan storage:link
```

### Build assets
```bash
# build assets
$ npm run dev
# Generating assets while developing
$ npm run watch
```

### Local Development Server
If you have PHP installed locally and you would like to use PHP's built-in development server to serve your application, you may use the serve Artisan command. This command will start a development server at `http://localhost:8000`:

```bash
$ php artisan serve
```
