<?php

namespace Domain;

class OrderShipingProduct
{
    protected $orderProduct;

    protected $shipmentSupplier;

    protected $shipmentCost;

    public function __construct(
        OrderProduct $orderProduct, 
        ShipmentSupplier $shipmentSupplier,
        float $shipmentCost
    ) {
        $this->orderProduct = $orderProduct;
        $this->shipmentSupplier = $shipmentSupplier;
        $this->shipmentCost = $shipmentCost;
    }

    public function orderProduct(): OrderProduct
    {
        return $this->orderProduct;
    }

    public function shipmentSupplier(): ShipmentSupplier
    {
        return $this->shipmentSupplier;
    }

    public function shipmentCost(): ?float
    {
        return $this->shipmentCost;
    }
}
