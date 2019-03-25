<?php
  return [
    // Contains the application's connection key
    'key' => env('SYNCAD_KEY', false),

    // Contains the application's display color
    'color' => env('SYNCAD_COLOR', '#42e5f4'),

    // Contains the URL to redirect to upon login
    'login_redirect' => env('SYNCAD_LOGIN_REDIRECT_URL', '/admin'),

    // Contains the application's display name
    'name' => env('APP_NAME', 'Syncad Project'),
  ];