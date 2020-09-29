<?php

namespace app;


abstract class NumberComplex implements ComplexNumberInterface
{
    protected $real;
    protected $imaginary;

    /**
     * @return mixed
     */
    public function getImaginary()
    {
        return $this->imaginary;
    }

    /**
     * @return mixed
     */
    public function getReal()
    {
        return $this->real;
    }

    public function setReal($value)
    {
        if ($this->checkValue($value)){
            $this->real = $value;
        }
    }

    public function setImaginary($value)
    {
        if ($this->checkValue($value)){
            $this->imaginary = $value;
        }
    }

    /**
     * @return float|int
     */
    public function getResult()
    {
        if ($this->real === 0 && $this->imaginary === 0) {
            return 0;
        }
        return round(hypot($this->real, $this->imaginary), 4);
    }

    /**
     * @param $value
     * @return bool
     * @throws \Exception
     */
    protected function checkValue($value)
    {
        if (!is_numeric($value)) {
            throw new \Exception('Ошибка, переменная не является числом!');
        }
        return true;
    }
}