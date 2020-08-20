<?php

use Domain\OrderProduct;
use Domain\ShipmentSupplier;

$description = 'Fone de ouvido Gamer';
$distance = 65;
$weight = 1;
$orderProduct = new OrderProduct($description, $distance, $weight);

$name = 'BoaDex';
$fixedCost = 10;
$costPerDistance = 0.05;
$boaDex = new ShipmentSupplier($name, $fixedCost, $costPerDistance);

it('asserts Order Product read-only values', function() use ($orderProduct) {
    assertEquals('Fone de ouvido Gamer', $orderProduct->description());
    assertEquals(65, $orderProduct->distance());
    assertEquals(1, $orderProduct->weight());
});

it('asserts BoaDex read-only values', function() use ($boaDex) {
    assertEquals('BoaDex', $boaDex->name());
    assertEquals(10, $boaDex->fixedCost());
    assertEquals(0.05, $boaDex->costPerDistance());
});

it('asserts BoaDex Gamer Headphones cost')
    ->assertEquals(13.25, $boaDex->calculate($orderProduct));
