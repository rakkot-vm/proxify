<?php


namespace App\Traites;


use App\Interfaces\CallerInterface;
use Exception;
use InvalidArgumentException;

trait Where
{

    public function where(string $field, string $cond, $expected)
    {
        if(empty($this->users)) return $this;

        $this->checkExpectedType($expected);
        $this->checkCondition($cond);
        $this->checkField($field);

        $this->removeNonMatchingUsers($field, $cond, $expected);

        return $this;
    }

    private function removeNonMatchingUsers(string $field, string $cond, $expected)
    {
        $notEqualedUsers = [];
        $equaledUsers = [];

        foreach ($this->users as $index => $user){
            if($user[$field] != $expected) {
                $notEqualedUsers[] = $user;
            }else{
                $equaledUsers[] = $user;
            }
        }

        $this->users = $cond == '!=' ? $notEqualedUsers : $equaledUsers;
    }

    /**
     * @param $expected
     */
    private function checkExpectedType($expected)
    {
        $isProperType = in_array(gettype($expected), ['boolean', 'integer', 'string']);

        if(!$isProperType) {
            throw new InvalidArgumentException('expected param should be one of boolean, intenger, string.');
        }
    }

    /**
     * @param $expected
     */
    private function checkCondition($cond)
    {
        if($cond != '!=' && $cond != '=') {
            throw new InvalidArgumentException('Condition can only be "!=" or "=".');
        }
    }

    /**
     * @param $field
     * @throws Exception
     */
    private function checkField($field)
    {
        if(!isset($this->users[0][$field])) {
            throw new Exception('Field "'. $field .'" not found in user array');
        }
    }
}