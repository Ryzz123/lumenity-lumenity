<?php

namespace Lumenity\Framework\app\http\controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lumenity\Framework\common\config\app\view as View;

/**
 * Welcome Controller
 *
 * This controller handles requests related to the welcome page.
 */
class WelcomeController
{
    /**
     * Show Welcome Page
     *
     * This method renders the welcome page with the specified title and content.
     *
     * @param Request $req The HTTP request
     * @param Response $res The HTTP response
     * @return void
     * @throws Exception
     */
    public function index(Request $req, Response $res): void
    {
        View::render('welcome', [
            'title' => 'Welcome to Lumenity Framework',
            'content' => 'This is a simple PHP framework for building web applications.'
        ]);
    }
}