<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class FoneDeOuvidoCEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Fone de ouvido', 33, 1);
    }
}
