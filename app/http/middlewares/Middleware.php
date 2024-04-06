<?php

namespace Lumenity\Framework\app\http\middlewares;

use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;

interface Middleware
{
    function before(Request $req, Response $res): void;
}