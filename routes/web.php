<?php

use Lumenity\Framework\config\common\app\route as Route;

Route::get('/', function () {
    view('welcome', [
        'title' => 'Welcome to Lumenity Framework',
        'content' => 'This is a simple PHP framework for building web applications.'
    ]);
});