<?php

namespace Lumenity\Framework\config\common\http;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\app\pagination;
use Lumenity\Framework\config\common\app\store;
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
    public static function pagination(array $data): pagination
    {
        return new pagination($data);
    }

    /**
     * @throws Exception
     */
    public static function store(string $path, object $file, ?string $hashname = null): string
    {
        return store::store($path, $file, $hashname);
    }

    /**
     * @throws Exception
     */
    public static function delete(string $path, string $fileName): bool
    {
        return store::delete($path, $fileName);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public static function redirect(string $url): void
    {
        View::redirect($url);
    }
}