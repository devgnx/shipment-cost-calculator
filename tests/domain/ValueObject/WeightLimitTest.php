<?php

use Domain\ValueObject\WeightLimit;

$empty = new WeightLimit();
$small = new WeightLimit(null, 5);
$large = new WeightLimit(5.1);

it('asserts weight limit instance', function() use ($empty, $small, $large) {
    assertInstanceOf(WeightLimit::class, $empty);
    assertInstanceOf(WeightLimit::class, $small);
    assertInstanceOf(WeightLimit::class, $large);
});

it('asserts weight limit values', function() use ($empty, $small, $large) {
    assertNull($empty->minWeight());
    assertNull($empty->maxWeight());

    assertNull($small->minWeight());
    assertEquals(5, $small->maxWeight());

    assertNull($large->maxWeight());
    assertEquals(5.1, $large->minWeight());
});

it('asserts can handle when weight limit is empty')
    ->assertTrue($empty->canHandle(100));

it('asserts can handle weight limit small limits', function() use ($small) {
    assertTrue($small->canHandle(0));
    assertTrue($small->canHandle(5));
    assertFalse($small->canHandle(5.1));
});

it('asserts can handle weight limit large limits', function() use ($large) {
    assertFalse($large->canHandle(0));
    assertFalse($large->canHandle(5));
    assertTrue($large->canHandle(5.1));
    assertTrue($large->canHandle(200));
});
