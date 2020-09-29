<?php


namespace Tests\Unit\App\Components\Validator;


class EqualTest extends ValidatorBase
{
    public function testVarsEqual()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'equal',
            ['asdasd', 'asdasd']
        );

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
        $this->assertEmpty($this->validator->error);
    }

    public function testVarsNotEqual()
    {
        $result = $this->invokeMethod(
            $this->validator,
            'equal',
            ['asdasd', 'notLikeThePrevious']
        );

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
        $this->assertNotEmpty($this->validator->error);
    }
}