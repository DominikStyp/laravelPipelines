<?php
declare(strict_types=1);
namespace App\Pipelines\Validators;
use App\Pipelines\AbstractPipe;
use App\Pipelines\Exceptions\ValidationException;

class OneNumber extends AbstractPipe
{

    public function handle(string $content, \Closure $next)
    {
        if(preg_match("#[0-9]+#", $content)){
            return $next($content);
        }
        throw new ValidationException("No number in string");
    }
}
