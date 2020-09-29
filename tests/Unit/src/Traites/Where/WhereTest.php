<?php


namespace Tests\Unit\App\Traites\Where;


class WhereTest extends WhereBase
{

    public function testFoundEqual()
    {
        $this->setUsers();
        $result = $this->whereTrait->where('id', '=', 1);

        $this->assertInstanceOf(get_class($this->whereTrait), $result );
        $this->assertCount(1, $result->users);
        $this->assertEquals('1', $result->users[0]['id']);
    }

    public function testFoundNotEqual()
    {
        $this->setUsers();
        $usersCount = (count($this->whereTrait->users) - 1);

        $result = $this->whereTrait->where('id', '!=', 1);

        $this->assertInstanceOf(get_class($this->whereTrait), $result );
        $this->assertCount($usersCount, $result->users);
    }

    public function testUsersIsEmpty()
    {
        $this->setEmptyUsers();
        $result = $this->whereTrait->where('id', '!=', 1);

        $this->assertInstanceOf(get_class($this->whereTrait), $result);
        $this->assertCount(0, $result->users);
        $this->assertEmpty($result->users);
    }
}