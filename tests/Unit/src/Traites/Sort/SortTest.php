<?php


namespace Tests\Unit\App\Traites\Sort;


class SortTest extends SortBase
{
    public function testUsersIsEmpty()
    {
        $this->setEmptyUsers();
        $result = $this->sortTrait->sort('id', 'ASC');

        $this->assertInstanceOf(get_class($this->sortTrait), $result );
        $this->assertEmpty($result->users);
    }

    public function testSortAscString()
    {
        $this->setUsers();
        $result = $this->sortTrait->sort('login', 'ASC');

        $this->assertInstanceOf(get_class($this->sortTrait), $result );
        $this->assertEquals($result->users, $this->getUsersSortedByStringAsc());
    }

    public function testSortDescInt()
    {
        $this->setUsers();
        $result = $this->sortTrait->sort('id', 'DESC');

        $this->assertInstanceOf(get_class($this->sortTrait), $result );
        $this->assertEquals($this->sortTrait->users, $this->getUsersSortedByIntDesc());
    }
}