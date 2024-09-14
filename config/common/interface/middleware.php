<?php

namespace Lumenity\Framework\config\common\interface;

use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\http\Response;

interface middleware
{
    function before(Request $req, Response $res): void;
}