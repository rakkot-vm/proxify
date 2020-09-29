<?php

namespace Tests\Unit\App\Caller;


use App\Caller;
use InvalidArgumentException;

class MakeTest  extends CallerBase
{
    public function testInvalidUrl()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->caller->make('bad url');
    }

    public function testInvalidMethod()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->caller->make('https://api.github.com/users', 'any instead of get');
    }

    public function testProperRequest()
    {
        $result = $this->caller->make('https://api.github.com/users', 'get');

        $this->assertInstanceOf(Caller::class, $result);
        $this->assertIsArray($result->users);
        $this->assertNotEmpty($result->users);
    }
}