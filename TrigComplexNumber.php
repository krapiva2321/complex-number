<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 29.09.2020
 * Time: 15:16
 */

namespace app;


class TrigComplexNumber extends NumberComplex
{
    protected $mod;
    protected $angle;
    /**
     * TrigComplexNumber constructor.
     * @param int $m модуль числа
     * @param int $a угол в градусах
     * @throws \Exception
     */
    public function __construct($m = 0, $a = 0)
    {
        if ($this->checkValue($m) && $this->checkValue($a)) {
            $this->mod = $m;
            $this->angle = $a;
            $this->buildAlgParams();
        }
    }

    /**
     * @param $value
     * @throws \Exception
     */
    public function setMod($value)
    {
        if ($this->checkValue($value)){
            $this->mod = $value;
            $this->buildAlgParams();
        }
    }

    /**
     * @param $value
     * @throws \Exception
     */
    public function setAngle($value)
    {
        if ($this->checkValue($value)){
            $this->angle = $value;
            $this->buildAlgParams();
        }
    }

    /**
     * @param $value
     * @return mixed|void
     */
    public function setReal($value)
    {
        parent::setReal($value);
        $this->mod = $this->getResult();
        $this->angle = $this->mod != 0 ? round(rad2deg(acos($this->real / $this->mod)), 2) : 0;
    }

    /**
     * @param $value
     * @return mixed|void
     */
    public function setImaginary($value)
    {
        parent::setImaginary($value);
        $this->mod = $this->getResult();
        $this->angle = $this->mod != 0 ? round(rad2deg(asin($this->imaginary / $this->mod)), 2) : 0;
    }

    /**
     * @return mixed
     */
    public function getMod()
    {
        return $this->mod;
    }

    /**
     * @return mixed
     */
    public function getAngle()
    {
        return $this->angle;
    }

    private function buildAlgParams(): void
    {
        $this->real = (round($this->mod*cos(deg2rad($this->angle)), 4));
        $this->imaginary = (round($this->mod*sin(deg2rad($this->angle)), 4));
    }
}