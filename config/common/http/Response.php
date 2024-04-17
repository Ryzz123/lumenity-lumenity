<?php

namespace Lumenity\Framework\config\common\http;

use Exception;
use Lumenity\Framework\config\common\app\view as View;
use Illuminate\Http\Response as Responses;

class Response extends Responses
{
    public function __construct($content = '', $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
    }

    /**
     * @throws Exception
     */
    public static function view(string $view, array $data = []): void
    {
        View::render($view, $data);
        exit();
    }

    /**
     * @throws Exception
     */
    public static function redirect(string $url): void
    {
        View::redirect($url);
    }
}