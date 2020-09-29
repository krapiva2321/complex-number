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
        self::checkTrigTransform();
        self::setMessage('Конец тестирования');
    }

    protected static function checkNumberStr(): void
    {
        try {
            new AlgComplexNumber(0, 'bbbb');
        } catch (\Exception $e) {
            self::setMessage('Мнимая переменная alg проверена (конструктор) +');
        }

        try {
            $nc = new AlgComplexNumber(1, 1);
            $nc->setImaginary('bbbb');
        } catch (\Exception $e) {
            self::setMessage('Мнимая переменная alg проверена (сеттер) +');
        }

        try {
            new AlgComplexNumber('aaaa', 0);
        } catch (\Exception $e) {
            self::setMessage('Действительная переменная alg проверена (конструктор) +');
        }

        try {
            $nc = new AlgComplexNumber(1, 1);
            $nc->setReal('aaaa');
        } catch (\Exception $e) {
            self::setMessage('Действительная переменная alg проверена (сеттер) +');
        }

        try {
            new TrigComplexNumber(0, 'bbbb');
        } catch (\Exception $e) {
            self::setMessage('Модуль числа trig проверен (конструктор) +');
        }

        try {
            $nc = new TrigComplexNumber(1, 1);
            $nc->setImaginary('bbbb');
        } catch (\Exception $e) {
            self::setMessage('Мнимая переменная trig проверена (сеттер) +');
        }

        try {
            $nc = new TrigComplexNumber(1, 1);
            $nc->setMod('bbbb');
        } catch (\Exception $e) {
            self::setMessage('Модуль числа trig проверен (сеттер) +');
        }

        try {
            new TrigComplexNumber('aaaa', 0);
        } catch (\Exception $e) {
            self::setMessage('Угол trig проверен (конструктор) +');
        }

        try {
            $nc = new TrigComplexNumber(1, 1);
            $nc->setReal('aaaa');
        } catch (\Exception $e) {
            self::setMessage('Действительная переменная trig проверена (сеттер) +');
        }

        try {
            $nc = new TrigComplexNumber(1, 1);
            $nc->setAngle('aaaa');
        } catch (\Exception $e) {
            self::setMessage('Угол trig проверен (сеттер) +');
        }
    }

    protected static function checkAdd(): void
    {
        self::setNull('alg','add', new AlgComplexNumber(0, 0), new AlgComplexNumber(0, 0));
        self::setNull('alg+trig','add', new AlgComplexNumber(0, 0), new TrigComplexNumber(0, 0));
        self::setNull('trig','add', new TrigComplexNumber(0, 0), new TrigComplexNumber(0, 0));

        self::checkAlgorithm('alg','add', new AlgComplexNumber(5, 3),new AlgComplexNumber(2,1), 8.0623 );
        self::checkAlgorithm('alg+trig','add', new AlgComplexNumber(5, 3),new TrigComplexNumber(5, 53.13), 10.6301 );
        self::checkAlgorithm('trig','add', new TrigComplexNumber(4, 53.13),new TrigComplexNumber(5, 53.13), 9 );
    }

    protected static function checkSub(): void
    {
        self::setNull('alg','sub', new AlgComplexNumber(0, 0), new AlgComplexNumber(0,0));
        self::setNull('alg+trig','sub', new AlgComplexNumber(0, 0), new TrigComplexNumber(0, 0));
        self::setNull('trig','sub', new TrigComplexNumber(0, 0), new TrigComplexNumber(0, 0));

        self::checkAlgorithm('alg','sub', new AlgComplexNumber(5, 3),new AlgComplexNumber(2,1), 3.6056 );
        self::checkAlgorithm('alg+trig','sub', new AlgComplexNumber(5, 3), new TrigComplexNumber(5, 53.13), 2.2361 );
        self::checkAlgorithm('trig','sub', new TrigComplexNumber(4, 53.13), new TrigComplexNumber(5, 53.13), 1 );
    }

    protected static function checkMul(): void
    {

        self::setNull('alg','mul', new AlgComplexNumber(0, 0), new AlgComplexNumber(0, 0));
        self::setNull('alg+trig','mul', new AlgComplexNumber(0, 0), new TrigComplexNumber(0, 0));
        self::setNull('trig','mul', new TrigComplexNumber(0, 0), new TrigComplexNumber(0, 0));

        self::checkAlgorithm('alg','mul', new AlgComplexNumber(5, 3),new AlgComplexNumber(2,1), 13.0384 );
        self::checkAlgorithm('alg+trig','mul', new AlgComplexNumber(5, 3), new TrigComplexNumber(5, 53.13), 29.1548 );
        self::checkAlgorithm('trig','mul', new TrigComplexNumber(4, 53.13), new TrigComplexNumber(5, 53.13), 20 );
    }

    protected static function checkDiv(): void
    {
        self::setNull('alg','div', new AlgComplexNumber(0, 0), new AlgComplexNumber(0, 0));
        self::setNull('alg+trig','div', new AlgComplexNumber(0, 0), new TrigComplexNumber(0, 0));
        self::setNull('trig','div', new TrigComplexNumber(0, 0), new TrigComplexNumber(0, 0));

        self::checkAlgorithm('alg','div', new AlgComplexNumber(5, 3),new AlgComplexNumber(2,1), 0.3835 );
        self::checkAlgorithm('alg+trig','div', new AlgComplexNumber(5, 3), new TrigComplexNumber(5, 53.13), 0.8575 );
        self::checkAlgorithm('trig','div', new TrigComplexNumber(4, 53.13), new TrigComplexNumber(5, 53.13), 1.25 );
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
     * @param $num_type
     * @param $type
     * @param ComplexNumberInterface $first
     * @param ComplexNumberInterface $second
     */
    private static function setNull($num_type, $type, ComplexNumberInterface &$first, ComplexNumberInterface &$second)
    {
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
        if ($result->getResult() == 0) {
            self::setMessage($num_type . ' '. 'Алгоритм ' . $type . ' при 0 чисел +');
        } else {
            self::setMessage($num_type . ' ' . 'Алгоритм ' . $type . ' при 0 чисел -');
        }
    }

    /**
     * @param $num_type
     * @param $type
     * @param ComplexNumberInterface $first
     * @param ComplexNumberInterface $second
     * @param $result
     */
    private static function checkAlgorithm($num_type, $type, ComplexNumberInterface &$first, ComplexNumberInterface &$second, $result): void
    {
        switch ($type) {
            case 'add' :
                $alg = ComplexMath::add($first, $second);
                break;
            case 'sub' :
                $alg = ComplexMath::sub($first, $second);
                break;
            case 'mul' :
                $alg = ComplexMath::mul($first, $second);
                break;
            case 'div' :
                $alg = ComplexMath::div($first, $second);
                break;
        }
        if ($alg->getResult() != $result) {
            self::setMessage($num_type . ' ' . 'Алгоритм ' . $type . ' -');
        } else {
            self::setMessage($num_type . ' ' . 'Алгоритм ' . $type . ' +');
        }
    }

    /**
     * @throws \Exception
     */
    protected static function checkTrigTransform()
    {
        self::setMessage('Проверка пересчета тригонометрической формы');
        $tr = new TrigComplexNumber(5, 53.13);
        if ($tr->getReal() != 3) {
            self::setMessage('Ошибка расчета real');
        } else {
            self::setMessage('Верный расчет real');
        }
        if ($tr->getImaginary() != 4) {
            self::setMessage('Ошибка расчета imaginary');
        } else {
            self::setMessage('Верный расчет imaginary');
        }
        $tr->setReal(4);
        $tr->setImaginary(3);

        if ($tr->getMod() != 5) {
            self::setMessage('Ошибка пересчета mod');
        } else {
            self::setMessage('Верный пересчета mod');
        }

        if ($tr->getAngle() != 36.87) {
            self::setMessage('Ошибка пересчета angle');
        } else {
            self::setMessage('Верный пересчета angle');
        }
        self::setMessage('Конец проверки');
    }
}
