<?php

namespace App\Entity\OrderProduct;

use Domain\OrderProduct;

class ControleXboxAEntity extends OrderProduct
{
    public function __construct()
    {
        parent::__construct('Controle Xbox', 1, 3);
    }
}
