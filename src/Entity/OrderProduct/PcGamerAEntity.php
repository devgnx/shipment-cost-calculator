<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class PcGamerAEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Pc Gamer', 1, 35);
    }
}
