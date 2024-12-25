<?php

namespace Lumenity\Framework\app\http\controllers;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class AppController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function index(): void
    {
        view('app');
    }
}