<?php


namespace Tests\Unit\App\Components\Validator;


class HasErrorTest extends ValidatorBase
{
    public function testErrorExists()
    {
        $this->validator->error = 'sometestError';

        $result = $this->validator->hasError();

        $this->assertIsBool($result);
        $this->assertEquals(true, $result);
    }

    public function testErrorNotExists()
    {
        $result = $this->validator->hasError();

        $this->assertIsBool($result);
        $this->assertEquals(false, $result);
    }
}