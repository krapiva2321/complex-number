<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 29.09.2020
 * Time: 15:16
 */

namespace app;


class AlgComplexNumber extends NumberComplex
{
    public function __construct($a = 0, $b = 0)
    {
        $this->setReal($a);
        $this->setImaginary($b);
    }
}