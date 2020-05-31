<?php
declare(strict_types=1);
namespace App\Pipelines\Validators;
use App\Pipelines\AbstractPipe;
use App\Pipelines\Exceptions\ValidationException;

class OneSpecialChar extends AbstractPipe
{

    public function handle(string $content, \Closure $next)
    {
        if(preg_match("#[^a-zA-Z0-9]+#", $content)){
            return $next($content);
        }
        throw new ValidationException("No special character in string");
    }
}
