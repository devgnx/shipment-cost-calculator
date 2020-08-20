<?php

namespace App\Entity\ShipmentSupplier;

use Domain\ShipmentSupplier;
use Domain\ValueObject\WeightLimit;

class TransboaLightEntity extends ShipmentSupplier
{
    public function __construct()
    {
        $weightLimit = new WeightLimit(null, 5);
        parent::__construct('Transboa (até 5kg)', 2.10, 1.1, $weightLimit);
    }
}
