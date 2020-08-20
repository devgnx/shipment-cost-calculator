<?php

namespace Domain\ValueObject;

class RandomNumber
{
    protected $value;

    public function __construct()
    {
        $this->value = random_int(0, 100);
    }

    public function value()
    {
        return $this->value;
    }
}
