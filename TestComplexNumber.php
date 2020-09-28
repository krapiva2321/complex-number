<?php

namespace app;


class TestComplexNumber
{
    public static function run()
    {
        self::setMessage('Начало тестирования');
        self::checkNumberStr();
        self::checkAdd();
        self::checkSub();
        self::checkMul();
        self::checkDiv();
        self::setMessage('Конец тестирования');
    }

    protected static function checkNumberStr(): void
    {
        try {
            new NumberComplex(0, 'bbbb');
        } catch (\Exception $e) {
            self::setMessage('Мнимая переменная проверена (конструктор) +');
        }
        try {
            $nc = new NumberComplex(1, 1);
            $nc->imaginary = 'bbbb';
        } catch (\Exception $e) {
            self::setMessage('Мнимая переменная проверена (сеттер) +');
        }
        try {
            new NumberComplex('aaaa', 0);
        } catch (\Exception $e) {
            self::setMessage('Действительная переменная проверена (конструктор) +');
        }

        try {
            $nc = new NumberComplex(1, 1);
            $nc->real = 'aaaa';
        } catch (\Exception $e) {
            self::setMessage('Действительная переменная проверена (сеттер) +');
        }
    }

    protected static function checkAdd(): void
    {
        self::setNull('add');
        self::checkAlgorithm('add');
    }

    protected static function checkSub(): void
    {
        self::setNull('sub');
        self::checkAlgorithm('sub');
    }

    protected static function checkMul(): void
    {
        self::setNull('mul');
        self::checkAlgorithm('mul');
    }

    protected static function checkDiv(): void
    {
        self::setNull('div');
        self::checkAlgorithm('div');
    }

    /**
     * @param $message
     */
    private static function setMessage($message)
    {
        //можно заменить на запись в файлик
        echo $message . "\n";
    }

    /**
     * @param $type
     */
    private static function setNull($type)
    {
        $first = new NumberComplex(0, 0);
        $second = new NumberComplex(0,0);
        switch ($type) {
            case 'add' :
                $result = ComplexMath::add($first, $second);
                break;
            case 'sub' :
                $result = ComplexMath::sub($first, $second);
                break;
            case 'mul' :
                $result = ComplexMath::mul($first, $second);
                break;
            case 'div' :
                $result = ComplexMath::div($first, $second);
                break;
        }
        if ($result === 0) {
            self::setMessage('Алгоритм ' . $type . ' при 0 чисел +');
        } else {
            self::setMessage('Алгоритм ' . $type . ' при 0 чисел -');
        }
    }

    /**
     * @param $type
     */
    private static function checkAlgorithm($type): void
    {
        $first = new NumberComplex(5, 3);
        $second = new NumberComplex(2,1);
        switch ($type) {
            case 'add' :
                $result = ComplexMath::add($first, $second);
                $standard = 8.0623;
                break;
            case 'sub' :
                $result = ComplexMath::sub($first, $second);
                $standard = 3.6056;
                break;
            case 'mul' :
                $result = ComplexMath::mul($first, $second);
                $standard = 13.0384;
                break;
            case 'div' :
                $result = ComplexMath::div($first, $second);
                $standard = 0.3835;
                break;
        }
        if ($result !== $standard) {
            self::setMessage('Алгоритм ' . $type . ' -');
        } else {
            self::setMessage('Алгоритм ' . $type . ' +');
        }
    }
}
