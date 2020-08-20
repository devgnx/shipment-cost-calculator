<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class ControleXboxBEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Controle Xbox', 100, 3);
    }
}
