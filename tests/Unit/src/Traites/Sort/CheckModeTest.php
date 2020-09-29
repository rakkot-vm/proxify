<?php


namespace Tests\Unit\App\Traites\Sort;


use InvalidArgumentException;

class CheckModeTest extends SortBase
{
    public function testInvalidMode()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->invokeMethod($this->sortTrait, 'checkMode', ['someInvalidMode']);
    }

    public function testValidMode()
    {
        $result = $this->invokeMethod($this->sortTrait, 'checkMode', ['asc']);
        $this->assertNull($result);

        $result = $this->invokeMethod($this->sortTrait, 'checkMode', ['desc']);
        $this->assertNull($result);
    }
}