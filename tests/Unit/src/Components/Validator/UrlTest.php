<?php


namespace Tests\Unit\App\Components\Validator;


class UrlTest extends ValidatorBase
{
    public function testValidUrl()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'url',
            ['https://readthedocs.io/']
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
        $this->assertEmpty($this->validator->error);
    }

    public function testInValidUrl()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'url',
            ['someInvalidUrl']
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
        $this->assertNotEmpty($this->validator->error);
    }
}