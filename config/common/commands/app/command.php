<?php

namespace Lumenity\Framework\config\common\commands\app;
use Rakit\Console\App;

interface command
{
    public function create(App $app, ?string $name): void;
}