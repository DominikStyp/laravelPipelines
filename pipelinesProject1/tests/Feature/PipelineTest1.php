<?php

namespace Tests\Unit;
namespace Tests\Feature;

use App\Pipelines\Validators\Length;
use App\Pipelines\Validators\OneCapitalLetter;
use App\Pipelines\Validators\OneNumber;
use App\Pipelines\Validators\OneSpecialChar;
use App\Pipelines\Exceptions\ValidationException;
use Illuminate\Pipeline\Pipeline;
use Tests\TestCase;

class PipelineTest1 extends TestCase
{

    private function runThroughPipeline(string $str)
    {
        /** @var Pipeline $pipeline */

        $pipes = [
            Length::class,
            OneNumber::class,
            OneCapitalLetter::class,
            OneSpecialChar::class
        ];
        app(Pipeline::class)->send($str)->through($pipes)->then(function($result){
            echo "String {$result} validated throuth pipelines!";
        });
    }

    public function testPasswordTooShort()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("String length out of range");
        $this->runThroughPipeline("abc");
    }

    public function testPasswordTooLong()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("String length out of range");
        $this->runThroughPipeline(str_repeat("a",200));
    }

    public function testPasswordDoesntHaveNumber()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("No number in string");
        $this->runThroughPipeline("my_super_password");
    }
}
