<?php

it('It formats a phone number', function () {
    $number = new \Iamfredric\Phone\PhoneNumber('+4611101010');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('011 10 10 10');
    expect((string) $number)->toBe('011 10 10 10');
    expect($number->__toString())->toBe('011 10 10 10');
    expect($number->tel())->toBe('+4611101010');
    expect($number->full())->toBe('0046 (0)11 10 10 10');

    $number = new \Iamfredric\Phone\PhoneNumber('+46708111010');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('070 811 10 10');
    expect((string) $number)->toBe('070 811 10 10');
    expect($number->__toString())->toBe('070 811 10 10');
    expect($number->tel())->toBe('+46708111010');
    expect($number->full())->toBe('0046 (0)70 811 10 10');

    $number = new \Iamfredric\Phone\PhoneNumber('+46141200200');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('0141 20 02 00');
    expect((string) $number)->toBe('0141 20 02 00');
    expect($number->__toString())->toBe('0141 20 02 00');
    expect($number->tel())->toBe('+46141200200');
    expect($number->full())->toBe('0046 (0)141 20 02 00');

    $number = new \Iamfredric\Phone\PhoneNumber('+4687020090');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('08 702 00 90');
    expect((string) $number)->toBe('08 702 00 90');
    expect($number->__toString())->toBe('08 702 00 90');
    expect($number->tel())->toBe('+4687020090');
    expect($number->full())->toBe('0046 (0)8 702 00 90');

    $number = new \Iamfredric\Phone\PhoneNumber('08-702 00 90');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('08 702 00 90');
    expect((string) $number)->toBe('08 702 00 90');
    expect($number->__toString())->toBe('08 702 00 90');
    expect($number->tel())->toBe('+4687020090');
    expect($number->full())->toBe('0046 (0)8 702 00 90');

    $number = new \Iamfredric\Phone\PhoneNumber('0046 (0)8 702 00 90');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('08 702 00 90');
    expect((string) $number)->toBe('08 702 00 90');
    expect($number->__toString())->toBe('08 702 00 90');
    expect($number->tel())->toBe('+4687020090');
    expect($number->full())->toBe('0046 (0)8 702 00 90');

    $number = new \Iamfredric\Phone\PhoneNumber('0046 08 702 00 90');
    expect($number->exists())->toBeTrue();
    expect($number->readable())->toBe('08 702 00 90');
    expect((string) $number)->toBe('08 702 00 90');
    expect($number->__toString())->toBe('08 702 00 90');
    expect($number->tel())->toBe('+4687020090');
    expect($number->full())->toBe('0046 (0)8 702 00 90');

    $number = new \Iamfredric\Phone\PhoneNumber('');
    expect($number->exists())->toBeFalse();
    expect($number->readable())->toBeEmpty();
    expect((string) $number)->toBeEmpty();
    expect($number->__toString())->toBeEmpty();
    expect($number->tel())->toBeEmpty();
    expect($number->full())->toBeEmpty();
});
