<?php

namespace Lumenity\Framework\app\http\controllers;

use Exception;
use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;

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
        $res::view('welcome', [
            'title' => 'Welcome to Lumenity Framework',
            'content' => 'This is a simple PHP framework for building web applications.'
        ]);
    }

    /**
     * Health Check
     *
     * This method returns a simple JSON response indicating the status of the application.
     * @param Request $req
     * @param Response $res
     * @return void
     */
    public function healthCheck(Request $req, Response $res): void
    {
        $res->setContent(['status' => 'ok'])
            ->setStatusCode(200)
            ->send();
    }
}