<?php

namespace Domain;

class OrderProduct
{
    protected $description;

    protected $distance;

    protected $weight;

    public function __construct(string $description, float $distance, float $weight)
    {
        $this->description = $description;
        $this->distance = $distance;
        $this->weight = $weight;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function distance(): float
    {
        return $this->distance;
    }

    public function weight(): float
    {
        return $this->weight;
    }
}
