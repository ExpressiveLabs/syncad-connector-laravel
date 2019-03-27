# Syncad-Connector-Laravel

Recommended tools to complete this integration:<br>
☕🎶💻⏰<br>
This package allows to easily connect any Laravel application to an instance of the syncad application management platform.

## Table of contents
1. [Installation](#installation)<br>
    1. [Using Composer](#using-composer)
2. [Configuration](#configuration)
    1. [Connecting things up](#connecting-things-up)
    1. [Configuration options](#configuration-options)
3. [Usage](#usage)
    1. [connection/test](#post-connectiontest)
    1. [login/init](#post-logininit)
4. [Bugs](#bugs)


## Installation
### Using Composer
First of all, install the package. Y'all know the drill, but as a reminder:<br>
`composer require mainstreamct/syncad-connector-laravel`<br>
Then publish the configuration files using:<br/>
```php artisan vendor:publish```

###### Laravel 5.5 and below
For Laravel 5.5 and below, add this to your `config/app.php`:
```php
// Providers array:
  mainstreamct\SyncadConnectorLaravel\SyncadConnectorServiceProvider::class,
// Aliases array:
  'Syncad' => mainstreamct\SyncadConnectorLaravel\Syncad::class,
```

###### Laravel 5.6 and up
You're all ready to rock! Thanks to package discovery, you don't need to manually add the service provider to your `config/app.php`.

## Configuration
### Connecting things up
1. Log in to your Syncad installation and go to Admin > Apps
2. Click '+' (Add existing application)
3. Fill out your app's details (location, application key)
4. Connect!

### Configuration options
In `config/syncad.php`, you'll find the following options:
1. `key` contains your application key, this should be set in your `.env` file
1. `color` specifies a unique app color used in your Syncad dashboard to distinguish your application
1. `name` is the application name that is stored on your Syncad instance upon connecting. It defaults to your `.env`'s `APP_NAME` key

## Usage

This package exposes the following endpoints that are used by Syncad.

#### [POST] `connection/test`
```Params: key```<br>
This endpoint tests the connection using the provided `key`. It returns an array of environment data used by Syncad to personalize your application.

#### [POST] `login/init`
```Params: email, token, key```<br>
This endpoint returns a login token for a given user using their `email` and the stored `syncad_token`.

#### [GET] `ext/auth`
```Params: key```<br>
This endpoint logs the user in by the provided Syncad token `syncad_token`. This login token is  destroyed upon login. The user is then redirected to the `login_redirect` URL specified in `config/syncad.php`. 

## Bugs
Found a bug? Message us at [support@mainstreamct.com](mailto:support@mainstreamct.com) or contact us via the Support environment in your Mainstream Web Portal (MainstreamCT customers only).

Copyright © 2019 MainstreamCT