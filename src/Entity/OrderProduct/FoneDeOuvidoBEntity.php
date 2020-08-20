<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class FoneDeOuvidoBEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Fone de ouvido', 430, 1);
    }
}
