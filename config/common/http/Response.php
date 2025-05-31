<?php

namespace Lumenity\Framework\config\common\http;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\app\pagination;
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
     * Create Collection
     *
     * Creates a new collection instance from the given data.
     *
     * @param int $limit
     * @param int $page
     * @param Model|Builder $query
     * @return Collection The collection instance containing the data
     */
    public static function pagination(int $limit, int $page, Model|Builder $query): Collection
    {
        $pagination = new pagination($limit, $page, $query);
        return $pagination->paginate();
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public static function redirect(string $url): void
    {
        View::redirect($url);
    }
}