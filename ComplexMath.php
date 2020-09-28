<?php

namespace app;


class ComplexMath
{
    public static function add(NumberComplex $first, NumberComplex $second)
    {
        $resNum = new NumberComplex();
        $resNum->real = ($first->real + $second->real);
        $resNum->imaginary = ($first->imaginary + $second->imaginary);
        return $resNum->getResult();
    }

    public static function sub(NumberComplex $first, NumberComplex $second)
    {
        $resNum = new NumberComplex();
        $resNum->real = ($first->real - $second->real);
        $resNum->imaginary = ($first->imaginary - $second->imaginary);
        return $resNum->getResult();
    }

    public static function mul(NumberComplex $first, NumberComplex $second)
    {
        $resNum = new NumberComplex();
        $resNum->real = (($first->real * $second->real) - ($first->imaginary * $second->imaginary));
        $resNum->imaginary = (($first->real * $second->imaginary) + ($first->imaginary * $second->real));
        return $resNum->getResult();
    }

    public static function div(NumberComplex $first, NumberComplex $second)
    {
        if (($first->real + $first->imaginary) == 0) {
            return 0;
        }
        $resNum = new NumberComplex();
        $resNum->real = (($first->real * $second->real) + ($first->imaginary * $second->imaginary))/(pow($first->real, 2) + pow($first->imaginary, 2));
        $resNum->imaginary = (($first->imaginary * $second->real) - ($first->real * $second->imaginary))/(pow($first->real, 2) + pow($first->imaginary, 2));
        return $resNum->getResult();
    }
}