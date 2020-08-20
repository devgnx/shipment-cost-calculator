<?php

namespace App\Service;

use App\Entity\OrderProduct\ControleXboxAEntity;
use App\Entity\OrderProduct\ControleXboxBEntity;
use App\Entity\OrderProduct\FoneDeOuvidoAEntity;
use App\Entity\OrderProduct\FoneDeOuvidoBEntity;
use App\Entity\OrderProduct\FoneDeOuvidoCEntity;
use App\Entity\OrderProduct\FoneDeOuvidoDEntity;
use App\Entity\OrderProduct\KitGamerEntity;
use App\Entity\OrderProduct\PcGamerAEntity;
use App\Entity\OrderProduct\PcGamerBEntity;
use App\Entity\OrderProduct\TecladoFoneEntity;
use App\Entity\ShipmentSupplier\BoaDexEntity;
use App\Entity\ShipmentSupplier\BoaLogEntity;
use App\Entity\ShipmentSupplier\TransboaEntity;
use App\Entity\ShipmentSupplier\TransboaLightEntity;
use Domain\OrderProduct;
use Domain\ShipmentCostSorter;

class ShipmentCostService
{
    public $orderProducts;

    public $shipingSuppliers;

    public function __construct()
    {
        $this->orderProducts = [
            new FoneDeOuvidoAEntity(),
            new ControleXboxAEntity(),
            new PcGamerAEntity(),
            new FoneDeOuvidoBEntity(),
            new FoneDeOuvidoCEntity(),
            new FoneDeOuvidoDEntity(),
            new ControleXboxBEntity(),
            new KitGamerEntity(),
            new TecladoFoneEntity(),
            new PcGamerBEntity()
        ];

        $this->shipingSuppliers = [
            new BoaDexEntity(),
            new BoaLogEntity(),
            new TransboaEntity(),
            new TransboaLightEntity()
        ];
    }

    public function orderProducts(): array
    {
        return $this->orderProducts;
    }

    public function shipingSuppliers(): array
    {
        return $this->shipingSuppliers;
    }
    
    public function orderProductsShippingCostBySupplier()
    {
        $costSorter = new ShipmentCostSorter($this->shipingSuppliers);

        return array_map(function(OrderProduct $orderProduct) use ($costSorter) {
            return $costSorter->calculateAndSort($orderProduct);
        }, $this->orderProducts());
    }
}
