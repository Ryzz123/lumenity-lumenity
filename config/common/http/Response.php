<?php

namespace Lumenity\Framework\config\common\http;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\app\log as Log;
use Lumenity\Framework\config\common\app\pagination;
use Lumenity\Framework\config\common\app\paginationresult;
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
    #[NoReturn] public static function view(string $view, array $data = []): void
    {
        View::render($view, $data);
        exit();
    }

    /**
     * @throws Exception
     */
    public static function pagination(array $data, int $limit, int $page): paginationresult
    {
        return (new pagination($data))->limit($limit)->page($page)->paginate();
    }

    /**
     * Log Message
     *
     * Logs a message with the specified log level.
     *
     * @param string $message The message to be logged
     * @param string $type Optional. The log level (info, warning, error, debug, critical)
     * @return void
     */
    public static function log(string $message, string $type = 'info'): void
    {
        switch ($type) {
            case 'info':
                Log::info($message);
                break;
            case 'warning':
                Log::warning($message);
                break;
            case 'error':
                Log::error($message);
                break;
            case 'debug':
                Log::debug($message);
                break;
            case 'critical':
                Log::critical($message);
                break;
        }
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public static function redirect(string $url): void
    {
        View::redirect($url);
    }
}