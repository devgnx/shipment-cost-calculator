<?php

use Domain\ValueObject\WeightLimit;

$empty = new WeightLimit();
$light = new WeightLimit(null, 5);
$normal = new WeightLimit(5.1);

it('asserts weight limit instance', function() use ($empty, $light, $normal) {
    assertInstanceOf(WeightLimit::class, $empty);
    assertInstanceOf(WeightLimit::class, $light);
    assertInstanceOf(WeightLimit::class, $normal);
});

it('asserts weight limit values', function() use ($empty, $light, $normal) {
    assertNull($empty->minWeight());
    assertNull($empty->maxWeight());

    assertNull($light->minWeight());
    assertEquals(5, $light->maxWeight());

    assertNull($normal->maxWeight());
    assertEquals(5.1, $normal->minWeight());
});

it('asserts can handle when weight limit is empty')
    ->assertTrue($empty->canHandle(100));

it('asserts can handle weight limit light limits', function() use ($light) {
    assertTrue($light->canHandle(0));
    assertTrue($light->canHandle(5));
    assertFalse($light->canHandle(5.1));
});

it('asserts can handle weight limit normal limits', function() use ($normal) {
    assertFalse($normal->canHandle(0));
    assertFalse($normal->canHandle(5));
    assertTrue($normal->canHandle(5.1));
    assertTrue($normal->canHandle(200));
});
