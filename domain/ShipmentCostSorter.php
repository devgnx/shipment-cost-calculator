<?php

namespace Domain;

class ShipmentCostSorter
{
    protected $orderProduct;

    protected $shipmentSuppliers;

    public function __construct(array $shipmentSuppliers)
    {
        $this->shipmentSuppliers = $shipmentSuppliers;
    }

    public function shipmentSuppliers(): array
    {
        return $this->shipmentSuppliers;
    }

    public function calculateAndSort(OrderProduct $orderProduct)
    {
        $result = array_map(function(ShipmentSupplier $shipmentSupplier) use ($orderProduct) {
            if (!$shipmentSupplier->canHandle($orderProduct)) {
                return;
            }

            $shipmentCost = $shipmentSupplier->calculate($orderProduct);

            return new OrderShipingProduct(
                $orderProduct,
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
