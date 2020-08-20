<?php

use Domain\OrderProduct;
use Domain\OrderShipingProduct;
use Domain\ShipmentCostSorter;
use Domain\ShipmentSupplier;
use Domain\ValueObject\WeightLimit;

$description = 'Fone de ouvido Gamer';
$distance = 65;
$weight = 1;
$headset = new OrderProduct($description, $distance, $weight);

$description = 'PC Gamer';
$distance = 1;
$weight = 35;
$pcGamer = new OrderProduct($description, $distance, $weight);

$name = 'BoaDex';
$fixedCost = 10;
$costPerDistance = 0.05;
$boaDex = new ShipmentSupplier($name, $fixedCost, $costPerDistance);

$name = 'Transboa (até 5Kg)';
$fixedCost = 2.1;
$costPerDistance = 1.1;
$transboaLightLimits = new WeightLimit(null, 5);
$transboaLight = new ShipmentSupplier($name, $fixedCost, $costPerDistance, $transboaLightLimits);

$name = 'Transboa (+5Kg)';
$fixedCost = 10;
$costPerDistance = 0.01;
$transboaLimits = new WeightLimit(5.1);
$transboa = new ShipmentSupplier($name, $fixedCost, $costPerDistance, $transboaLimits);

$costSorter = new ShipmentCostSorter([
    $boaDex,
    $transboaLight,
    $transboa
]);

it('asserts Shipment Cost Sorter read-only values', function() use ($boaDex, $transboaLight, $transboa, $costSorter) {
    assertEquals([
        $boaDex,
        $transboaLight,
        $transboa
    ], $costSorter->shipmentSuppliers());
});

it('asserts Headset cost sort', function() use ($headset, $boaDex, $transboaLight, $costSorter) {
    $headsetboaDex = new OrderShipingProduct($headset, $boaDex, $boaDex->calculate($headset));
    $headsetTransboaLight = new OrderShipingProduct($headset, $transboaLight, $transboaLight->calculate($headset));

    assertEquals($headset, $headsetboaDex->orderProduct());
    assertEquals($boaDex, $headsetboaDex->shipmentSupplier());
    assertEquals(13.25, $headsetboaDex->shipmentCost());
    
    assertEquals([
        $headsetboaDex,
        $headsetTransboaLight
    ], $costSorter->calculateAndSort($headset));
});

it('asserts PC Gamer allowed shipment', function() use ($pcGamer, $boaDex, $transboa, $costSorter) {
    $pcGamerboaDex = new OrderShipingProduct($pcGamer, $boaDex, $boaDex->calculate($pcGamer));
    $pcGamerTransboa = new OrderShipingProduct($pcGamer, $transboa, $transboa->calculate($pcGamer));

    assertEquals($pcGamer, $pcGamerboaDex->orderProduct());
    assertEquals($boaDex, $pcGamerboaDex->shipmentSupplier());
    assertEquals(11.75, $pcGamerboaDex->shipmentCost());
    
    assertEquals([
        $pcGamerTransboa,
        $pcGamerboaDex,
    ], $costSorter->calculateAndSort($pcGamer));
});
