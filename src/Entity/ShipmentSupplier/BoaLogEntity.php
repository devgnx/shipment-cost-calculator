<?php

namespace App\Entity\ShipmentSupplier;

use Domain\ShipmentSupplier;

class BoaLogEntity extends ShipmentSupplier
{
    public function __construct()
    {
        parent::__construct('BoaLog', 4.3, 0.12);
    }
}
