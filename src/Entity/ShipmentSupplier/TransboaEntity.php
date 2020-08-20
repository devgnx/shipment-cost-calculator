<?php

namespace App\Entity\ShipmentSupplier;

use Domain\ShipmentSupplier;

class TransboaEntity extends ShipmentSupplier
{
    public function __construct()
    {
        parent::__construct('Transboa (+5kg)', 10, 0.01);
    }
}
