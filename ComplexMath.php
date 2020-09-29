<?php

namespace app;


class ComplexMath
{
    /**
     * @param ComplexNumberInterface $first
     * @param ComplexNumberInterface $second
     * @return AlgComplexNumber
     */
    public static function add(ComplexNumberInterface $first, ComplexNumberInterface $second): AlgComplexNumber
    {
        $resAlg = new AlgComplexNumber();
        $real = ($first->getReal() + $second->getReal());
        $imaginary = ($first->getImaginary() + $second->getImaginary());
        self::setArg($resAlg, $real, $imaginary);
        return $resAlg;
    }

    /**
     * @param ComplexNumberInterface $first
     * @param ComplexNumberInterface $second
     * @return AlgComplexNumber
     */
    public static function sub(ComplexNumberInterface $first, ComplexNumberInterface $second) : AlgComplexNumber
    {
        $resAlg = new AlgComplexNumber();
        $real = ($first->getReal() - $second->getReal());
        $imaginary = ($first->getImaginary() - $second->getImaginary());
        self::setArg($resAlg, $real, $imaginary);
        return $resAlg;
    }

    /**
     * @param ComplexNumberInterface $first
     * @param ComplexNumberInterface $second
     * @return AlgComplexNumber
     */
    public static function mul(ComplexNumberInterface $first, ComplexNumberInterface $second): AlgComplexNumber
    {
        $resAlg = new AlgComplexNumber();
        $real = (($first->getReal() * $second->getReal()) - ($first->getImaginary() * $second->getImaginary()));
        $imaginary = (($first->getReal() * $second->getImaginary()) + ($first->getImaginary() * $second->getReal()));
        self::setArg($resAlg, $real, $imaginary);
        return $resAlg;
    }

    /**
     * @param ComplexNumberInterface $first
     * @param ComplexNumberInterface $second
     * @return AlgComplexNumber
     */
    public static function div(ComplexNumberInterface $first, ComplexNumberInterface $second) : AlgComplexNumber
    {
        if (($first->getReal() + $first->getImaginary()) == 0) {
            return new AlgComplexNumber(0, 0);
        }
        $resAlg = new AlgComplexNumber();
        $real = (($first->getReal() * $second->getReal()) + ($first->getImaginary() * $second->getImaginary()))/(pow($first->getReal(), 2) + pow($first->getImaginary(), 2));
        $imaginary = (($first->getImaginary() * $second->getReal()) - ($first->getReal() * $second->getImaginary()))/(pow($first->getReal(), 2) + pow($first->getImaginary(), 2));
        self::setArg($resAlg, $real, $imaginary);
        return $resAlg;
    }

    /**
     * @param AlgComplexNumber $alg
     * @param $real
     * @param $imaginary
     */
    private static function setArg(AlgComplexNumber &$alg, &$real, &$imaginary)
    {
        $alg->setReal($real);
        $alg->setImaginary($imaginary);
    }
}