<?php


namespace App\Traites;


use InvalidArgumentException;

trait Sort
{
    /**
     * @param string $field
     * @param string $mode
     * @return $this
     */
    public function sort(string $field, string $mode = 'ASC')
    {
        if(empty($this->users)) return $this;
        $mode = strtolower($mode);
        $this->checkMode($mode);

        usort($this->users, function ($item1, $item2) use ($field, $mode) {
            $item1 = is_string($item1[$field]) ? strtolower($item1[$field]): $item1[$field];
            $item2 = is_string($item2[$field]) ? strtolower($item2[$field]): $item2[$field];

            return $item1 <=> $item2;
        });

        if($mode == 'desc'){
            $this->users = array_reverse($this->users);
        }

        return $this;
    }

    /**
     * @param string $mode
     */
    private function checkMode(string $mode)
    {
        if($mode != 'asc' && $mode != 'desc') {
            throw new InvalidArgumentException('Mode should be "ASC" or "DESC"');
        }
    }
}