<?php

namespace App\Entity\ShipmentSupplier;

use Domain\ShipmentSupplier;
use Domain\ValueObject\WeightLimit;

class TransboaEntity extends ShipmentSupplier
{
    public function __construct()
    {
        $weightLimit = new WeightLimit(5.1);
        parent::__construct('Transboa (+5kg)', 10, 0.01, $weightLimit);
    }
}
