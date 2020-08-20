<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class PcGamerBEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Pc Gamer', 1000, 35);
    }
}
