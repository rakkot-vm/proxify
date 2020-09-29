<?php


namespace Tests\Unit\App\Traites\Where;


use Exception;

class RemoveNonMatchingUsersTest extends WhereBase
{
    public function testFindOneEqualed()
    {
        $this->setUsers();
        $this->invokeMethod($this->whereTrait, 'removeNonMatchingUsers',['id', '=', 1]);

        $this->assertCount(1, $this->whereTrait->users);
        $this->assertEquals('1', $this->whereTrait->users[0]['id']);
    }

    public function testFindManyEqualed()
    {
        $this->setUsers();
        $this->invokeMethod($this->whereTrait, 'removeNonMatchingUsers', ['type', '=', 'User']);

        $this->assertIsArray($this->whereTrait->users);
        $this->assertNotEmpty($this->whereTrait->users);
    }

    public function testFindManyNotEqualed()
    {
        $this->setUsers();
        $this->invokeMethod($this->whereTrait, 'removeNonMatchingUsers', ['id', '!=', 1]);

        $this->assertIsArray($this->whereTrait->users);
        $this->assertNotEmpty($this->whereTrait->users);
    }

    public function testFindOneNotEqualed()
    {
        $this->setUsers();
        $this->whereTrait->users[0]['site_admin'] = 'onlyWhenDrunk';

        $this->invokeMethod($this->whereTrait, 'removeNonMatchingUsers', ['site_admin', '!=', false]);

        $this->assertCount(1, $this->whereTrait->users);
        $this->assertEquals('1', $this->whereTrait->users[0]['id']);
    }

    public function testFindNothing()
    {
        $this->setUsers();
        $this->invokeMethod($this->whereTrait, 'removeNonMatchingUsers', ['id', '=', 1111]);

        $this->assertEmpty($this->whereTrait->users);
    }
}