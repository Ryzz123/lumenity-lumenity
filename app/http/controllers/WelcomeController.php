<?php

namespace Lumenity\Framework\app\http\controllers;

use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;

class WelcomeController
{
    public function index(Request $req, Response $res): void
    {
        $res::view('welcome', [
            'title' => 'Welcome to Lumenity Framework',
            'content' => 'This is a simple PHP framework for building web applications.'
        ]);
    }
}