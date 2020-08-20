<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class FoneDeOuvidoDEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Fone de ouvido', 50, 1);
    }
}
