<?php


namespace Tests\Unit\App\Traites\Where;


use Exception;

class CheckFieldParamTest extends WhereBase
{
    public function testFieldExists()
    {
        $this->setUsers();

        $result = $this->invokeMethod($this->whereTrait, 'checkField',['node_id']);
        $this->assertNull( $result );
    }

    public function testFieldNotExists()
    {
        $this->setUsers();

        $this->expectException(Exception::class);
        $this->invokeMethod($this->whereTrait, 'checkField', ['notExistedField']);
    }
}