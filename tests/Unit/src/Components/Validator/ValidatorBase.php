<?php


namespace Tests\Unit\App\Components\Validator;


use App\Components\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorBase extends TestCase
{
    protected Validator $validator;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->validator = new Validator();
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