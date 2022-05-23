<?php

namespace JeroenBoumans\BMI;

use JeroenBoumans\BMI\Converter\TrafficLightConverter;
use JeroenBoumans\BMI\Enum\Gender;

class BMI
{
    /**
     * @param float $weight in kg
     * @param float $length in cm
     * @return void
     */
    public function __construct(
        public readonly float $weight,
        public readonly float $length,
        public readonly float $age,
        public readonly Gender $gender
    ) {
    }

    /**
     * @param float $weight in kg
     * @param float $length in cm
     * @param float $age
     * @param Gender $gender
     * @return self
     */
    public static function from(float $weight, float $length, float $age, Gender $gender): self
    {
        return new self(
            weight: $weight,
            length: $length,
            age: $age,
            gender: $gender
        );
    }

    /**
     * @return string
     */
    public function toTrafficLight(): string
    {
        return TrafficLightConverter::lookUp(
            gender: $this->gender,
            age: $this->age,
            bmi: $this->calculate()
        );
    }

    /**
     * @param int $precision
     * @return float
     */
    public function calculate(int $precision = 1): float
    {
        return round($this->weight / pow($this->length / 100, 2), $precision);
    }
}
