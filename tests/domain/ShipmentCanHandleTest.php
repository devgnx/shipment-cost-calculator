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
$transboaLightLimits = new WeightLimit(null, 5);
$transboaLight = new ShipmentSupplier($name, $fixedCost, $costPerDistance, $transboaLightLimits);

$name = 'Transboa (+5Kg)';
$fixedCost = 10;
$costPerDistance = 0.01;
$transboaLimits = new WeightLimit(5.1);
$transboa = new ShipmentSupplier($name, $fixedCost, $costPerDistance, $transboaLimits);

it('asserts Headset allowed shipment', function() use ($headset, $boaDex, $transboaLight, $transboa) {
    assertTrue($boaDex->canHandle($headset));

    assertTrue($transboaLight->canHandle($headset));

    assertFalse($transboa->canHandle($headset));
});

it('asserts PC Gamer allowed shipment', function() use ($pcGamer, $boaDex, $transboaLight, $transboa) {
    assertTrue($boaDex->canHandle($pcGamer));

    assertFalse($transboaLight->canHandle($pcGamer));

    assertTrue($transboa->canHandle($pcGamer));
});
