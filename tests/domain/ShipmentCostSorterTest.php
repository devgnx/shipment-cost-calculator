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
$transboaSmallLimits = new WeightLimit(null, 5);
$transboaSmall = new ShipmentSupplier($name, $fixedCost, $costPerDistance, $transboaSmallLimits);

$name = 'Transboa (+5Kg)';
$fixedCost = 10;
$costPerDistance = 0.01;
$transboaLargeLimits = new WeightLimit(5.1);
$transboaLarge = new ShipmentSupplier($name, $fixedCost, $costPerDistance, $transboaLargeLimits);

it('asserts Shipment Cost Sorter read-only values', function() use ($headset, $boaDex, $transboaSmall, $transboaLarge) {
    $costSorter = new ShipmentCostSorter($headset, [
        $boaDex,
        $transboaSmall,
        $transboaLarge
    ]);

    assertEquals($headset, $costSorter->orderProduct());
    assertEquals([
        $boaDex,
        $transboaSmall,
        $transboaLarge
    ], $costSorter->shipmentSuppliers());
});

it('asserts Headset cost sort', function() use ($headset, $boaDex, $transboaSmall, $transboaLarge) {

    $costSorter = new ShipmentCostSorter($headset, [
        $boaDex,
        $transboaSmall,
        $transboaLarge
    ]);

    $headsetboaDex = new OrderShipingProduct($headset, $boaDex, $boaDex->calculate($headset));
    $headsetTransboaSmall = new OrderShipingProduct($headset, $transboaSmall, $transboaSmall->calculate($headset));

    assertEquals($headset, $headsetboaDex->orderProduct());
    assertEquals($boaDex, $headsetboaDex->shipmentSupplier());
    assertEquals(13.25, $headsetboaDex->shipmentCost());
    
    assertEquals([
        $headsetboaDex,
        $headsetTransboaSmall
    ], $costSorter->calculateAndSort());
});

it('asserts PC Gamer allowed shipment', function() use ($pcGamer, $boaDex, $transboaSmall, $transboaLarge) {
    $costSorter = new ShipmentCostSorter($pcGamer, [
        $boaDex,
        $transboaSmall,
        $transboaLarge
    ]);

    $pcGamerboaDex = new OrderShipingProduct($pcGamer, $boaDex, $boaDex->calculate($pcGamer));
    $pcGamerTransboaLarge = new OrderShipingProduct($pcGamer, $transboaLarge, $transboaLarge->calculate($pcGamer));

    assertEquals($pcGamer, $pcGamerboaDex->orderProduct());
    assertEquals($boaDex, $pcGamerboaDex->shipmentSupplier());
    assertEquals(11.75, $pcGamerboaDex->shipmentCost());
    
    assertEquals([
        $pcGamerTransboaLarge,
        $pcGamerboaDex,
    ], $costSorter->calculateAndSort());
});
