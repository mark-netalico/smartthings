Smartthings PHP
=========
Smartthings PHP is a library for interfacing with the SmartThings home automation system through PHP.

Installation
----
Install with composer. Open your composer.json file and add the following to the require array:

```
"netalico/smartthings": "dev-master"
```

Install the dependencies
---
Run Composer to install or update the new requirement.

```
php composer install
```
or

```
php composer update
```
Now you are able to require the vendor/autoload.php file to autoload the package.


Laravel 4 Integration
====

After you have installed the package, just follow the instructions.

Smartthings PHP has optional support for Laravel 4 and it comes bundled with a Service Provider and a Facade for easy integration.

After installing the package, open your Laravel config file app/config/app.php and add the following lines.

In the $providers array add the following service provider for this package.

```
'Netalico\Smartthings\SmartthingsServiceProvider'
```

Configuration
---

After installing, you can publish the package configuration file into your application by running the following command:

```
php artisan config:publish netalico/smartthings
```

This will publish the config file to app/config/packages/netalico/smartthings/config.php where you can modify the package configuration.


Usage
====
This package provides a few basic methods for setting up the Oauth authentication with SmartThings and toggling switches and locks.