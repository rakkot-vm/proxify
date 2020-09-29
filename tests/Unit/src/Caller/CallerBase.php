<?php


namespace Tests\Unit\App\Caller;


use App\Caller;
use PHPUnit\Framework\TestCase;

class CallerBase extends TestCase
{
    /**
     * @var Caller
     */
    protected Caller $caller;

    /**
     * CallerBase constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataNamea
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->caller = new Caller();
    }

}