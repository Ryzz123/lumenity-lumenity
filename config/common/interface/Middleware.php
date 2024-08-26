<?php

namespace Lumenity\Framework\config\common\interface;

use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;

interface Middleware
{
    function before(Request $req, Response $res): void;
}