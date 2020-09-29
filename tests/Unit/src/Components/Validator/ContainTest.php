<?php


namespace Tests\Unit\App\Components\Validator;


class ContainTest extends ValidatorBase
{
    public function testStringContainSubstring()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'contain',
            ['StringSubSomeLetters', 'Sub']
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
        $this->assertEmpty($this->validator->error);
    }

    public function testStringNotContainSubstring()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'contain',
            ['StringSomeLetters', 'Sub']
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
        $this->assertNotEmpty($this->validator->error);
    }
}