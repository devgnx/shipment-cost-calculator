<?php

namespace Domain\ValueObject;

class WeightLimit
{
    protected $minWeight;

    protected $maxWeight;

    public function __construct(?float $minWeight = null, ?float $maxWeight = null) {
        $this->minWeight = $minWeight;
        $this->maxWeight = $maxWeight;
    }

    public function minWeight(): ?float
    {
        return $this->minWeight;
    }

    public function maxWeight(): ?float
    {
        return $this->maxWeight;
    }

    public function canHandle(float $weight): bool
    {
        if (is_null($this->minWeight) && is_null($this->maxWeight)) {
            return true;
        }

        if (!is_null($this->minWeight) && $weight < $this->minWeight) {
            return false;
        }

        if (!is_null($this->maxWeight) && $weight > $this->maxWeight) {
            return false;
        }

        return true;
    }
}
