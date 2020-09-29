<?php

use App\Caller;

require __DIR__ . '/vendor/autoload.php';

$caller = new Caller;
$caller->make('https://api.github.com/users', 'get');
$caller->where('site_admin','=', false);
$caller->sort('login', 'DESC');

echo 'example of "only":';
var_dump($caller->only(['login']));