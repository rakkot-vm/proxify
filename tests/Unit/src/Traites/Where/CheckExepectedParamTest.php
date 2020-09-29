<?php


namespace Tests\Unit\App\Traites\Where;


use InvalidArgumentException;

class CheckExepectedParamTest extends WhereBase
{
    public function testPropTypeOfExpected()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->invokeMethod($this->whereTrait, 'checkExpectedType',[null]);

        $this->expectException(InvalidArgumentException::class);
        $this->invokeMethod($this->whereTrait, 'checkExpectedType',[['array', 'type']]);

        $this->expectException(InvalidArgumentException::class);
        $this->invokeMethod($this->whereTrait, 'checkExpectedType',[
            new class{}
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->invokeMethod($this->whereTrait, 'checkExpectedType',[2.2]);
    }

    public function testWrongTypeOfExpected()
    {
        $result = $this->invokeMethod($this->whereTrait, 'checkExpectedType',[2]);
        $this->assertNull( $result );

        $result = $this->invokeMethod($this->whereTrait, 'checkExpectedType',['string']);
        $this->assertNull( $result );

        $result = $this->invokeMethod($this->whereTrait, 'checkExpectedType',[true]);
        $this->assertNull( $result );
    }

}