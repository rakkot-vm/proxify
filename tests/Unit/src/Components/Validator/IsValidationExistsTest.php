<?php


namespace Tests\Unit\App\Components\Validator;


use Exception;

class IsValidationExistsTest extends ValidatorBase
{
    public function testValidationExists()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'isValidationExists',
            ['url']
        );
        $this->assertNull($result);

        $result = $this->invokeMethod(
            $this->validator,
            'isValidationExists',
            ['equal']
        );
        $this->assertNull($result);
    }

    public function testValidationNotExists()
    {
        $this->expectException(Exception::class);
        $this->invokeMethod(
            $this->validator,
            'isValidationExists',
            ['someNotExistsValidation']
        );
    }

}