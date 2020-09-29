<?php


namespace Tests\Unit\App\Caller;


class RequestTest extends CallerBase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvalidMethod()
    {
        $response = $this->invokeMethod(
            $this->caller,
            'request',
            ['https://api.github.com/users', 'POST']
        );

        $this->assertJson($response);
        $this->assertJsonStringEqualsJsonString(
            '{"message":"Not Found","documentation_url":"https://docs.github.com/rest"}',
            $response
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testProperRequest()
    {
        $response = $this->invokeMethod(
            $this->caller,
            'request',
            ['https://api.github.com/users', 'GET']
        );

        $this->assertJson($response);
        $responseArr = json_decode($response, true);
        $this->assertArrayHasKey('login', $responseArr[0]);
        $this->assertArrayHasKey('id', $responseArr[0]);
        $this->assertArrayHasKey('node_id', $responseArr[0]);
    }

    /**
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    private function invokeMethod($object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}