<?php

namespace Lumenity\Framework\config\common\http;
use Exception;
use Illuminate\Http\Request as Requests;
use JetBrains\PhpStorm\NoReturn;

class Request extends Requests
{
    public array $matches = [];

    /**
     * @throws Exception
     */
    #[NoReturn] public function matches(): array
    {
        return $this->matches;
    }
}