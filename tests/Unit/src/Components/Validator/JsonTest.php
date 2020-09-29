<?php


namespace Tests\Unit\App\Components\Validator;


class JsonTest extends ValidatorBase
{
    public function testValidJsonl()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'json',
            ['{"js":"on", "2ndLevel":{"someKey1":"something","someKey2":"something2"}}']
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
        $this->assertEmpty($this->validator->error);
    }

    public function testInValidJsonl()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'json',
            ['{"not":"a":"json"}']
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
        $this->assertNotEmpty($this->validator->error);

        $result = $this->invokeMethod(
            $this->validator,
            'json',
            ['definitelyNotAJson']
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
        $this->assertNotEmpty($this->validator->error);
    }
}