<?php

namespace JeroenBoumans\BMI\Enum;

enum Category
{
    case OVERWEIGHT;
    case OBESE;
    case UNDERWEIGHT;
    case EXTREMELY_UNDERWEIGHT;
    case NORMAL;
}
