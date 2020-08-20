<?php

namespace Domain;

use Domain\ValueObject\WeightLimit;

class ShipmentSupplier
{
    protected $name;

    protected $fixedCost;

    protected $costPerDistance;

    protected $weightLimit;

    public function __construct(
        string $name, 
        float $fixedCost, 
        float $costPerDistance, 
        ?WeightLimit $weightLimit = null
    ) {
        $this->name = $name;
        $this->fixedCost = $fixedCost;
        $this->costPerDistance = $costPerDistance;
        $this->weightLimit = $weightLimit;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function fixedCost(): float
    {
        return $this->fixedCost;
    }

    public function costPerDistance(): float
    {
        return $this->costPerDistance;
    }

    public function canHandle(OrderProduct $orderProduct): bool
    {
        if (is_null($this->weightLimit)) {
            return true;
        }

        return $this->weightLimit->canHandle($orderProduct->weight());
    }

    public function calculate(OrderProduct $orderProduct): float
    {
        $productCost = ($orderProduct->weight() * $orderProduct->distance() * $this->costPerDistance());
        $result = $this->fixedCost + $productCost;

        return (float)$result;
    }
}
