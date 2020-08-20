<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class FoneDeOuvidoAEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Fone de ouvido', 1, 1);
    }
}
