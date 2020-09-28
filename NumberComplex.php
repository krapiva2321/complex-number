<?php

namespace app;


class NumberComplex
{
    protected $real;
    protected $imaginary;

    public function __construct($a = 0, $b = 0)
    {
        if ($this->checkValue($a)) {
            $this->real = $a;
        }
        if ($this->checkValue($b)) {
            $this->imaginary = $b;
        }
    }

    /**
     * @param $name
     * @param $value
     * @throws \Exception
     */
    public function __set($name, $value)
    {
        if ($this->checkValue($value)) {
            $this->$name = $value;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
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
    private function checkValue($value)
    {
        if (!is_numeric($value)) {
            throw new \Exception('Ошибка, переменная не является числом!');
        }
        return true;
    }
}