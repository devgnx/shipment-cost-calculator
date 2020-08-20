<?php

namespace App\Entity\ShipmentSupplier;

use Domain\ShipmentSupplier;

class BoaDexEntity extends ShipmentSupplier
{
    public function __construct()
    {
        parent::__construct('BoaDex', 10, 0.05);
    }
}
