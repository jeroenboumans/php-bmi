<?php

use Stimuliz\BMI\BMI;
use Stimuliz\BMI\Enum\Gender;

test('BMI value can be calculated correctly', function () {
    expect(BMI::from(65, 170, 12, Gender::MALE)->calculate())->toEqual(22.5);
    expect(BMI::from(65, 170, 12, Gender::MALE)->calculate(2))->toEqual(22.49);
});
