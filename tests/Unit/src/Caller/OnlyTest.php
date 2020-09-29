<?php


namespace Tests\Unit\App\Caller;

use App\Caller;

class OnlyTest extends CallerBase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->caller = new Caller();
    }

    public function testSeveralFields()
    {
        $this->setUsers();

        $only = $this->caller->only(['login', 'id']);
        $this->assertIsArray($only);
        $this->assertCount(3, $only);
        $this->assertCount(2, $only[0]);
        $this->assertArrayHasKey('login', $only[0]);
        $this->assertArrayHasKey('id', $only[0]);
    }

    public function testOneField()
    {
        $this->setUsers();

        $only = $this->caller->only(['login']);
        $this->assertIsArray($only);
        $this->assertCount(3, $only);
        $this->assertCount(1, $only[0]);
        $this->assertArrayHasKey('login', $only[0]);
    }

    public function testFieldNotFound()
    {
        $this->setUsers();
        $countUsers = count($this->caller->users);
        $countUserFields = count($this->caller->users[0]);

        $only = $this->caller->only(['someInvalidField']);
        $this->assertIsArray($only);
        $this->assertCount($countUsers, $only);
        $this->assertCount($countUserFields, $only[0]);
    }

    public function testEmptyUsers()
    {
        $this->setEmptyUsers();

        $only = $this->caller->only(['login']);
        $this->assertIsArray($only);
        $this->assertEmpty( $only);
    }

    protected function setUsers()
    {
        $this->caller->users = [
            ['login' => 'mojombo', 'id' => 2, 'node_id' => 'MDQ6VXNlcjE=', 'url' => 'https://api.github.com/users/mojombo'],
            ['login' => 'defunkt', 'id' => 3, 'node_id' => 'MDQ6VXNlcjE=', 'url' => 'https://api.github.com/users/defunkt'],
            ['login' => 'pjhyett', 'id' => 1, 'node_id' => 'MDQ6VXNlcjE=', 'url' => 'https://api.github.com/users/pjhyett']
        ];
    }

    protected function setEmptyUsers()
    {
        $this->caller->users = [];
    }
}