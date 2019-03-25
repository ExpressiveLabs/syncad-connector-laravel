# Syncad-Connector-Laravel

Recommended tools to complete this integration:<br>
☕🎶💻⏰<br>
This package allows to easily connect any Laravel application to an instance of the syncad application management platform.

## Table of contents
1. Installation

## Installation
#### Using Composer
The package can be installed using Composer:<br>
`composer require mainstreamct/syncad-connector-laravel`<br>
After installing, edit `config/app.php`:<br>
```php
   // Providers array:
   mainstreamct\SyncadConnectorLaravel\SyncadConnectorServiceProvider::class,
   
   // Aliases array:
   'Syncad' => mainstreamct\SyncadConnectorLaravel\Syncad::class,
```

## Configuration
