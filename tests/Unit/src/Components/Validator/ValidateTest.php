<?php


namespace Tests\Unit\App\Components\Validator;


use Exception;

class ValidateTest extends ValidatorBase
{
    public function testEmptyRules()
    {
        $result = $this->validator->validate(
            'someValue',
            []
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
    }

    public function testInvalidArrRule()
    {
        $this->expectException(Exception::class);
        $result = $this->validator->validate(
            'someValue',
            [['someInvalidRule', 'something']]
        );
    }

    public function testInvalidNotArrRule()
    {
        $this->expectException(Exception::class);
        $result = $this->validator->validate(
            'someValue',
            ['someInvalidRule']
        );
    }

    public function testValidArrRule()
    {
        $result = $this->validator->validate(
            'StringSubSomeLetters',
            [['contain', 'Sub']]
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }

    public function testValidNotArrRule()
    {
        $result = $this->validator->validate(
            'https://music.youtube.com/',
        ['url']
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }
}