<?php


namespace Tests\Unit\App\Components\Validator;


use Exception;

class ValidateAllTest extends ValidatorBase
{
    public function testNotExistsRule()
    {
        $this->expectException(Exception::class);
        $this->validator->validateAll(
            ['method' => 'get'],
            [
                'method' => [
                    ['someInvalidRule', 'get']
                ]
            ]
        );
    }

    public function testValidationTrue()
    {
        $result = $this->validator->validateAll(
            ['method' => 'get'],
            [
                'method' => [
                    ['equal', 'get']
                ]
            ]
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }

    public function testValidationFalse()
    {
        $result = $this->validator->validateAll(
            ['method' => 'somethingButNotGet'],
            [
                'method' => [
                    ['equal', 'get']
                ]
            ]
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
    }
}