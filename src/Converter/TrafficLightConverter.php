<?php

namespace JeroenBoumans\BMI\Converter;

use JeroenBoumans\BMI\Enum\Category;
use JeroenBoumans\BMI\Enum\Gender;

class TrafficLightConverter
{
    public static function lookUp(Gender $gender, int $age, float $bmi): string
    {
        $instance = new self();
        $columnValues = $instance->getCategoryValues(gender: $gender, age: $age);
        $category = null;

        foreach ($columnValues as $index => $value) {
            if ($bmi <= $value) {
                $category = self::categories[$index];
            }
        }

        return match ($category) {
            default => "red",
            Category::OVERWEIGHT,
            Category::UNDERWEIGHT => "orange",
            Category::NORMAL => "green"
        };
    }

    public function getCategoryValues(Gender $gender, int $age): array
    {
        if ($age > 1 && $age <= 18) {
            return self::values[ match ($gender) {
                Gender::FEMALE => "f",
                default => "m"
            }][$age];
        }

        return self::values["adult"];
    }

    private const categories = [
        Category::EXTREMELY_UNDERWEIGHT,
        Category::UNDERWEIGHT,
        Category::NORMAL,
        Category::OVERWEIGHT,

        // when none of the above apply
        Category::OBESE,
    ];

    private const values = [
        "adult" => [ 18.5, 25.0, 30.0, 40.0 ],
        "f" => [
            2 => [13.24, 13.9, 18.02, 19.81],
            3 => [12.98, 13.6, 17.56, 19.36],
            4 => [12.73, 13.34, 17.28, 19.15],
            5 => [12.5, 13.09, 17.15, 19.17],
            6 => [12.32, 12.93, 17.34, 19.65],
            7 => [12.26, 12.91, 17.75, 20.51],
            8 => [12.31, 13, 18.35, 21.57],
            9 => [12.44, 13.18, 19.07, 22.81],
            10 => [12.64, 13.43, 19.86, 24.11],
            11 => [12.95, 13.79, 20.74, 25.42],
            12 => [13.39, 14.28, 21.68, 26.67],
            13 => [13.92, 14.85, 22.58, 27.76],
            14 => [14.48, 15.43, 23.34, 28.57],
            15 => [15.01, 15.98, 23.94, 29.11],
            16 => [15.46, 16.44, 24.37, 29.43],
            17 => [15.78, 16.77, 24.7, 29.69],
            18 => [16, 17, 25, 30],
        ],
        "m" => [
            2 => [13.37, 14.12, 18.41, 20.09],
            3 => [13.09, 13.79, 17.89, 19.57],
            4 => [12.86, 13.52, 17.55, 19.29],
            5 => [12.66, 13.31, 17.42, 19.3],
            6 => [12.5, 13.15, 17.55, 19.78],
            7 => [12.42, 13.08, 17.92, 20.63],
            8 => [12.42, 13.11, 18.44, 21.6],
            9 => [12.5, 13.24, 19.1, 22.77],
            10 => [12.66, 13.45, 19.84, 24],
            11 => [12.89, 13.72, 20.55, 25.1],
            12 => [13.18, 14.05, 21.22, 26.02],
            13 => [13.59, 14.48, 21.91, 26.84],
            14 => [14.09, 15.01, 22.62, 27.63],
            15 => [14.6, 15.55, 23.29, 28.3],
            16 => [15.12, 16.08, 23.9, 28.88],
            17 => [15.6, 16.58, 24.46, 29.41],
            18 => [16, 17, 25, 30],
        ],
    ];
}
