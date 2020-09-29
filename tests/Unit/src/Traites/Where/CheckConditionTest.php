<?php


namespace Tests\Unit\App\Traites\Where;


use App\Interfaces\CallerInterface;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\Traites\Where;

class CheckConditionTest extends WhereBase
{
    public function testPropTypeOfCondition()
    {
        $result = $this->invokeMethod($this->whereTrait, 'checkCondition',['=']);
        $this->assertNull( $result );

        $result = $this->invokeMethod($this->whereTrait, 'checkCondition',['!=']);
        $this->assertNull( $result );
    }

    public function testWrongTypeOfCondition()
    {
        $this->expectException(Exception::class);
        $this->invokeMethod($this->whereTrait, 'checkCondition',['>']);
    }

}