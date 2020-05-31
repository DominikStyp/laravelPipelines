<?php
declare(strict_types=1);

namespace App\Pipelines;

interface Pipe
{
    public function handle(string $content, \Closure $next);
}
