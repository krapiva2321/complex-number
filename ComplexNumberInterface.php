<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 29.09.2020
 * Time: 15:47
 */

namespace app;


interface ComplexNumberInterface
{
    /**
     * @return mixed
     */
    public function getReal();

    /**
     * @return mixed
     */
    public function getImaginary();

    /**
     * @param $value
     * @return mixed
     */
    public function setReal($value);

    /**
     * @param $value
     * @return mixed
     */
    public function setImaginary($value);
}