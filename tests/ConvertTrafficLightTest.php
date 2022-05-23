<?php

use JeroenBoumans\BMI\BMI;
use JeroenBoumans\BMI\Converter\TrafficLightConverter;
use JeroenBoumans\BMI\Enum\Gender;

test('Correct column chosen', function () {
    expect((new TrafficLightConverter())
        ->getCategoryValues(gender: Gender::MALE, age: 12))
        ->toEqual([13.18, 14.05, 21.22, 26.02]);
});

test('BMI value can be calculated correctly', function () {
    expect(BMI::from(weight: 65, length: 170, age: 18, gender: Gender::MALE)->toTrafficLight())->toEqual('orange');
});
