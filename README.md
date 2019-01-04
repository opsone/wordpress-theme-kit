opsone/wordpress-theme-kit
=====

Create empty wordpress theme with minimal developper kit

## Installation

Install composer in your project:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Simply install with composer:

```bash
$ php composer.phar create-project opsone/wordpress-theme-kit path/to/install/
```

## webpack 4

Launch watcher files, Mode Development

```bash
$ npm start
```

Make for Production

```bash
$ npm run build
```

## Assets

Use assets file in templates wordpress

```php
$ echo asset_url('logo.png');
$ // dev => http://localhost:3000/d8de0a51d2c1ffadf2674553ff70fad2.png
$ // prod => http://localhost/assets/dist/d8de0a51d2c1ffadf2674553ff70fad2.png
```
