<?php

namespace Domain;

class ShipmentCostSorter
{
    protected $orderProduct;

    protected $shipmentSuppliers;

    public function __construct(OrderProduct $orderProduct, array $shipmentSuppliers)
    {
        $this->orderProduct = $orderProduct;
        $this->shipmentSuppliers = $shipmentSuppliers;
    }

    public function orderProduct(): OrderProduct
    {
        return $this->orderProduct;
    }

    public function shipmentSuppliers(): array
    {
        return $this->shipmentSuppliers;
    }

    public function calculateAndSort()
    {
        $result = array_map(function(ShipmentSupplier $shipmentSupplier) {
            if (!$shipmentSupplier->canHandle($this->orderProduct())) {
                return;
            }

            $shipmentCost = $shipmentSupplier->calculate($this->orderProduct);

            return new OrderShipingProduct(
                $this->orderProduct,
                $shipmentSupplier,
                $shipmentCost
            );
        }, $this->shipmentSuppliers);

        $result = array_filter($result);

        usort($result, function (OrderShipingProduct $a, OrderShipingProduct $b) {
            return $a->shipmentCost() <=> $b->shipmentCost();
        });

        return $result;
    }
}
