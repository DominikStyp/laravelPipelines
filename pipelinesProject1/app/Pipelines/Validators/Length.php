<?php
declare(strict_types=1);
namespace App\Pipelines\Validators;
use App\Pipelines\AbstractPipe;
use App\Pipelines\Exceptions\ValidationException;

class Length extends AbstractPipe
{

    public function handle(string $content, \Closure $next)
    {
        if(strlen($content) > 6 && strlen($content) < 50){
            return $next($content);
        }
        throw new ValidationException("String length out of range");
    }
}
