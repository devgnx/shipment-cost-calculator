<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class TecladoFoneEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Teclado + Fone', 5, 6);
    }
}
