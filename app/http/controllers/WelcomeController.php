<?php

namespace Lumenity\Framework\app\http\controllers;

use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;

class WelcomeController
{
    public function index(Request $req, Response $res): void
    {
        view('view', [
            'title' => 'Title Here'
        ]);
    }
}