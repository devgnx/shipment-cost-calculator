<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class KitGamerEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Kit Gamer', 1000, 5);
    }
}
