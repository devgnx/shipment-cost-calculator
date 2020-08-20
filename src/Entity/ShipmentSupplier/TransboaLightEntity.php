<?php

namespace App\Entity\ShipmentSupplier;

use Domain\ShipmentSupplier;

class TransboaLightEntity extends ShipmentSupplier
{
    public function __construct()
    {
        parent::__construct('Transboa (até 5kg)', 2.10, 1.1);
    }
}
