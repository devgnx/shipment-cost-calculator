<?php

use Domain\OrderProduct;
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

it('asserts Headset allowed shipment', function() use ($headset, $boaDex, $transboaSmall, $transboaLarge) {
    assertTrue($boaDex->canHandle($headset));

    assertTrue($transboaSmall->canHandle($headset));

    assertFalse($transboaLarge->canHandle($headset));
});

it('asserts PC Gamer allowed shipment', function() use ($pcGamer, $boaDex, $transboaSmall, $transboaLarge) {
    assertTrue($boaDex->canHandle($pcGamer));

    assertFalse($transboaSmall->canHandle($pcGamer));

    assertTrue($transboaLarge->canHandle($pcGamer));
});
