<?php

namespace App;

use App\Components\Validator;
use App\Interfaces\CallerInterface;
use App\Traites\Sort;
use App\Traites\Where;
use Exception;
use InvalidArgumentException;

class Caller implements CallerInterface
{
    use Sort, Where;

    public array $users = [];

    const VALIDATION_RULES = [
        'url' => [
            'url',
            ['contain', 'api.github.com/users']
        ],
        'method' => [
            ['equal', 'get']
        ],
    ];

    /**
     * @param string $url
     * @param string $method
     * @return $this|CallerInterface
     * @throws Exception
     */
    public function make(string $url, string $method = 'GET'): CallerInterface
    {
        $validator = new Validator();
        /* I use method only because it was in the task description, but here the method is validating and the true method is only GET*/
        $validator->validateAll(compact(['url', 'method']), self::VALIDATION_RULES);
        if($validator->hasError()) throw new InvalidArgumentException($validator->error);

        $response = $this->request($url, $method);
        $this->users = json_decode($response, true);

        return $this;
    }

    /**
     * @param string $url
     * @param string $method
     * @return string
     */
    private function request(string $url, string $method): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => ['User-Agent: Test caller']
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * @return array
     */
    public function get() : array
    {
        return $this->users;
    }

    /**
     * @param array $fields
     * @return array
     */
    public function only(array $fields) : array
    {
        if(!$this->users) return $this->users;

        $fields = array_flip($fields);
        if(!array_intersect_key($this->users[0], $fields)) return $this->users;

        $filteredUsers = [];

        foreach($this->users as $key => $user) {
            $filteredUsers[$key] = array_intersect_key($user, $fields);
        }

        return $filteredUsers;
    }
}