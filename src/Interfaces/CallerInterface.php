<?php


namespace App\Interfaces;


interface CallerInterface
{
    public function make(string $url, string $method = 'GET'): CallerInterface;

    public function get(): array;

    public function only(array $names) : array;
}