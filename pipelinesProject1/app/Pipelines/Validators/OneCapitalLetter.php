<?php
declare(strict_types=1);
namespace App\Pipelines\Validators;
use App\Pipelines\AbstractPipe;
use App\Pipelines\Exceptions\ValidationException;

class OneCapitalLetter extends AbstractPipe
{

    public function handle(string $content, \Closure $next)
    {
        if(preg_match("#[A-Z]+#", $content)){
            return $next($content);
        }
        throw new ValidationException("No capital letter in string");
    }
}
