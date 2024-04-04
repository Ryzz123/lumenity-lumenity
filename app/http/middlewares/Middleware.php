<?php

namespace Lumenity\Framework\app\http\middlewares;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface Middleware
{
    function before(Request $req, Response $res): void;
}