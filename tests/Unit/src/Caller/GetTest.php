<?php


namespace Tests\Unit\App\Caller;


class GetTest extends CallerBase
{
    public function testGetFilledUsers()
    {
        $make = $this->caller->make('https://api.github.com/users', 'get');

        $get = $make->get();
        $this->assertIsArray($get);
        $this->assertNotEmpty($get);
    }

    public function testGetEmptyUsers()
    {
        $get = $this->caller->get();

        $this->assertIsArray($get);
        $this->assertEmpty($get);
    }
}