<?php

use Domain\ValueObject\RandomNumber;

$number = new RandomNumber();
$otherNumber = new RandomNumber();

it('asserts random number value is numeric')
    ->assertTrue(is_numeric($number->value()));

it('asserts it is a random number')
    ->assertTrue($number->value() !== $otherNumber->value());
