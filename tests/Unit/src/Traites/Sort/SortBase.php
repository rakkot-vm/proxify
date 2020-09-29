<?php


namespace Tests\Unit\App\Traites\Sort;


use App\Traites\Sort;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SortBase extends TestCase
{
    protected MockObject $sortTrait;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->sortTrait = $this->getMockForTrait(Sort::class);
    }

    protected function setUsers()
    {
        $this->sortTrait->users = [
            ['login' => 'mojombo', 'id' => 2],
            ['login' => 'defunkt', 'id' => 3],
            ['login' => 'pjhyett', 'id' => 1]
        ];
    }

    protected function getUsersSortedByIntDesc()
    {
        return [
            ['login' => 'defunkt', 'id' => 3],
            ['login' => 'mojombo', 'id' => 2],
            ['login' => 'pjhyett', 'id' => 1]
        ];
    }

    protected function getUsersSortedByStringAsc()
    {
        return [
            ['login' => 'defunkt', 'id' => 3],
            ['login' => 'mojombo', 'id' => 2],
            ['login' => 'pjhyett', 'id' => 1]
        ];
    }

    protected function setEmptyUsers()
    {
        $this->sortTrait->users = [];
    }

    /**
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    protected function invokeMethod($object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}