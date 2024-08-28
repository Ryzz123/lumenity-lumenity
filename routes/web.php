<?php

use Lumenity\Framework\config\common\app\route as Route;

Route::get('/', function () {
    view('welcome');
});