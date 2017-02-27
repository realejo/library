<?php

namespace RealejoTest;

use Realejo\TimeFormatter;

/**
 * RW_Time test case.
 *
 * @link      http://github.com/realejo/libraray-zf1
 * @copyright Copyright (c) 2014 Realejo (http://realejo.com.br)
 * @license   http://unlicense.org
 */
class TimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RW_Time
     */
    private $RW_Time;

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests RW_Math::moda()
     */
    public function testGet()
    {

        /**
         * SEGUNDOS
         */
        // 1 segundo
        $time = new TimeFormatter(1);
        $this->assertSame('01', $time->get(TimeFormatter::SECOND));
        $this->assertSame('1', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 1 segundo
        $time = new TimeFormatter(1, TimeFormatter::SECOND);
        $this->assertSame('01', $time->get(TimeFormatter::SECOND));
        $this->assertSame('1', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13 segundos
        $time = new TimeFormatter(13);
        $this->assertSame('13', $time->get(TimeFormatter::SECOND));
        $this->assertSame('13', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13 segundos
        $time = new TimeFormatter(13, TimeFormatter::SECOND);
        $this->assertSame('13', $time->get(TimeFormatter::SECOND));
        $this->assertSame('13', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 63 segundos
        $time = new TimeFormatter(63);
        $this->assertSame('03', $time->get(TimeFormatter::SECOND));
        $this->assertSame('3', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('01', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('1', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 63 segundos
        $time = new TimeFormatter(63, TimeFormatter::SECOND);
        $this->assertSame('03', $time->get(TimeFormatter::SECOND));
        $this->assertSame('3', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('01', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('1', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        /**
         * MINUTOS
         */

        // 1 minuto
        $time = new TimeFormatter(60);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('01', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('1', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 1 minuto
        $time = new TimeFormatter(1, TimeFormatter::MINUTE);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('01', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('1', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13 minutos
        $time = new TimeFormatter(13 * 60);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13 minutos
        $time = new TimeFormatter(13, TimeFormatter::MINUTE);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13,5 minutos
        $time = new TimeFormatter(13 * 60 + 30);
        $this->assertSame('30', $time->get(TimeFormatter::SECOND));
        $this->assertSame('30', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13,5 minutos
        $time = new TimeFormatter(13.5, TimeFormatter::MINUTE);
        $this->assertSame('30', $time->get(TimeFormatter::SECOND));
        $this->assertSame('30', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        // 13:30 minutos
        $time = new TimeFormatter('13:30', TimeFormatter::MINUTE . ':' . TimeFormatter::SECOND);
        $this->assertSame('30', $time->get(TimeFormatter::SECOND));
        $this->assertSame('30', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::HOUR));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        /**
         * HORAS
         */

        // 1 hora
        $time = new TimeFormatter(60 * 60);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('01', $time->get(TimeFormatter::HOUR));
        $this->assertSame('1', $time->get(TimeFormatter::HOUR_SHORT));

        // 1 hora
        $time = new TimeFormatter(1, TimeFormatter::HOUR);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('01', $time->get(TimeFormatter::HOUR));
        $this->assertSame('1', $time->get(TimeFormatter::HOUR_SHORT));

        // 120 horas
        $time = new TimeFormatter(120 * 60 * 60);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('120', $time->get(TimeFormatter::HOUR));
        $this->assertSame('120', $time->get(TimeFormatter::HOUR_SHORT));

        // 120 horas
        $time = new TimeFormatter(120, TimeFormatter::HOUR);
        $this->assertSame('00', $time->get(TimeFormatter::SECOND));
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('00', $time->get(TimeFormatter::MINUTE));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('120', $time->get(TimeFormatter::HOUR));
        $this->assertSame('120', $time->get(TimeFormatter::HOUR_SHORT));

        // 27 horas
        $time = new TimeFormatter(27 * 60 * 60);
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('27', $time->get(TimeFormatter::HOUR_SHORT));

        // 27 horas
        $time = new TimeFormatter(27, TimeFormatter::HOUR);
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('27', $time->get(TimeFormatter::HOUR_SHORT));

        // 27,5 horas
        $time = new TimeFormatter(27.5 * 60 * 60);
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('30', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('27', $time->get(TimeFormatter::HOUR_SHORT));

        // 27,5 horas
        $time = new TimeFormatter(27.5, TimeFormatter::HOUR);
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('30', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('27', $time->get(TimeFormatter::HOUR_SHORT));

        // 13:45:3
        $time = new TimeFormatter(13 * 60 * 60 + 45 * 60 + 3);
        $this->assertSame('3', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('45', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::HOUR_SHORT));

        // 13:45:03 minutos
        $time = new TimeFormatter('13:45:3',
            TimeFormatter::HOUR . ':' . TimeFormatter::MINUTE . ':' . TimeFormatter::SECOND);
        $this->assertSame('3', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('45', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::HOUR_SHORT));

        /**
         * FORMATOS
         */
        $time = new TimeFormatter('13:24', TimeFormatter::HOUR . ':' . TimeFormatter::MINUTE);
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('24', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::HOUR_SHORT));

        $time = new TimeFormatter('13:24');
        $this->assertSame('24', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        $time = new TimeFormatter('13:24:15');
        $this->assertSame('15', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('24', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::HOUR_SHORT));

        // hora inválida
        $time = new TimeFormatter('13:60:00');
        $this->assertSame('0', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('0', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('14', $time->get(TimeFormatter::HOUR_SHORT));

        // formato teoricamnente inválido
        $time = new TimeFormatter('13:24', TimeFormatter::SECOND . ':' . TimeFormatter::MINUTE);
        $this->assertSame('13', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('24', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('0', $time->get(TimeFormatter::HOUR_SHORT));

        /**
         * \DateTime
         */
        $time = new TimeFormatter(\DateTime::createFromFormat('d/m/Y H:i:s', '12/01/2012 13:24:45'));
        $this->assertSame('45', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('24', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('13', $time->get(TimeFormatter::HOUR_SHORT));

    }

    /**
     * Tests \Realejo\TimeFormatter::toString()
     */
    public function testToString()
    {
        $time = new TimeFormatter(49503); // 13:45:3,
        $this->assertSame('13:45:03', $time->toString());
        $this->assertSame('13:45:03', $time->toString('hh:mm:ss'));
        $this->assertSame('13:45:3', $time->toString('h:m:s'));
        $this->assertSame('3', $time->toString('s'));
        $this->assertSame('03', $time->toString('ss'));
        $this->assertSame('45', $time->toString('m'));
        $this->assertSame('13', $time->toString('h'));
        $this->assertSame('=> 13', $time->toString('=> h'));

        $this->assertSame('13:45:03', $time->toString());
        $this->assertSame('13:45:03', $time->toString('Shh:mm:ss'));
        $this->assertSame('13:45:3', $time->toString('Sh:m:s'));
        $this->assertSame('3', $time->toString('Ss'));
        $this->assertSame('03', $time->toString('Sss'));
        $this->assertSame('45', $time->toString('Sm'));
        $this->assertSame('13', $time->toString('Sh'));
        $this->assertSame('=> 13', $time->toString('=> Sh'));

        $time = new TimeFormatter(-49503); // 13:45:3,
        $this->assertSame('-13:45:03', $time->toString());
        $this->assertSame('13:45:03', $time->toString('hh:mm:ss'));
        $this->assertSame('13:45:3', $time->toString('h:m:s'));
        $this->assertSame('3', $time->toString('s'));
        $this->assertSame('03', $time->toString('ss'));
        $this->assertSame('45', $time->toString('m'));
        $this->assertSame('13', $time->toString('h'));
        $this->assertSame('=> 13', $time->toString('=> h'));
        $this->assertSame('-', $time->toString('S'));

        $this->assertSame('-13:45:03', $time->toString('Shh:mm:ss'));
        $this->assertSame('-13:45:3', $time->toString('Sh:m:s'));
        $this->assertSame('-3', $time->toString('Ss'));
        $this->assertSame('-03', $time->toString('Sss'));
        $this->assertSame('-45', $time->toString('Sm'));
        $this->assertSame('-13', $time->toString('Sh'));
        $this->assertSame('=> -13', $time->toString('=> Sh'));

    }

    /**
     * Tests \Realejo\TimeFormatter::setSeconds()
     */
    public function testSetSeconds()
    {
        $time = new TimeFormatter(3);
        $this->assertSame('00:00:27', $time->setSeconds(27)->toString());
        $this->assertSame('00:01:13', $time->setSeconds(73)->toString());

        $time = new TimeFormatter('27:3');
        $this->assertSame('00:27:27', $time->setSeconds(27)->toString());
        $this->assertSame('00:28:13', $time->setSeconds(73)->toString());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame('13:27:27', $time->setSeconds(27)->toString());
        $this->assertSame('13:28:13', $time->setSeconds(73)->toString());
    }

    /**
     * Tests \Realejo\TimeFormatter::setMinutes()
     */
    public function testSetMinutes()
    {
        $time = new TimeFormatter(61);
        $this->assertSame('00:27:01', $time->setMinutes(27)->toString());
        $this->assertSame('01:13:01', $time->setMinutes(73)->toString());

        $time = new TimeFormatter('27:3');
        $this->assertSame('00:32:03', $time->setMinutes(32)->toString());
        $this->assertSame('01:13:03', $time->setMinutes(73)->toString());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame('13:27:03', $time->setMinutes(27)->toString());
        $this->assertSame('14:13:03', $time->setMinutes(73)->toString());
    }

    /**
     * Tests \Realejo\TimeFormatter::setHours()
     */
    public function testSetHours()
    {
        $time = new TimeFormatter(61);
        $this->assertSame('27:01:01', $time->setHours(27)->toString());

        $time = new TimeFormatter('27:3');
        $this->assertSame('32:27:03', $time->setHours(32)->toString());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame('32:03:00', $time->setHours(32)->toString());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame('32:27:03', $time->setHours(32)->toString());
    }

    /**
     * Tests \Realejo\TimeFormatter::setTime()
     */
    public function testSetTimeException()
    {
        try {
            $this->RW_Time->setTime('abcde');
        } catch (\Exception $expected) {
            return;
        }

        $this->fail('Exception não foi enviada.');
    }

    /**
     * Tests \Realejo\TimeFormatter::getSeconds()
     */
    public function testGetSeconds()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61, $time->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3, $time->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60, $time->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3, $time->getSeconds());

        $time = new TimeFormatter(61, TimeFormatter::MINUTE);
        $this->assertSame(61 * 60, $time->getSeconds());

        $time = new TimeFormatter(61, TimeFormatter::HOUR);
        $this->assertSame(61 * 60 * 60, $time->getSeconds());

        $time = new TimeFormatter(13, TimeFormatter::MINUTE);
        $this->assertSame(13 * 60, $time->getSeconds());

        $time = new TimeFormatter(13, TimeFormatter::HOUR);
        $this->assertSame(13 * 60 * 60, $time->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::getMinutes()
     */
    public function testGetMinutes()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 / 60, $time->getMinutes());

        $time = new TimeFormatter('27:3');
        $this->assertSame((27 * 60 + 3) / 60, $time->getMinutes());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame((27 * 60 * 60 + 3 * 60) / 60, $time->getMinutes());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame((13 * 60 * 60 + 27 * 60 + 3) / 60, $time->getMinutes());

        $time = new TimeFormatter(61, TimeFormatter::MINUTE);
        $this->assertSame(61, $time->getMinutes());

        $time = new TimeFormatter(61, TimeFormatter::HOUR);
        $this->assertSame(61 * 60, $time->getMinutes());
    }

    /**
     * Tests \Realejo\TimeFormatter::getHours()
     */
    public function testGetHours()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 / 3600, $time->getHours());

        $time = new TimeFormatter('27:3');
        $this->assertSame((27 * 60 + 3) / 3600, $time->getHours());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame((27 * 60 * 60 + 3 * 60) / 3600, $time->getHours());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame((13 * 60 * 60 + 27 * 60 + 3) / 3600, $time->getHours());
    }

    /**
     * Tests \Realejo\TimeFormatter::addSeconds()
     */
    public function testAddSeconds()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 + 13, $time->addSeconds(13)->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 + 13, $time->addSeconds(13)->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13, $time->addSeconds(13)->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13, $time->addSeconds(13)->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::subSeconds()
     */
    public function testSubSeconds()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 - 13, $time->subSeconds(13)->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 - 13, $time->subSeconds(13)->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13, $time->subSeconds(13)->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13, $time->subSeconds(13)->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::addMinutes()
     */
    public function testAddMinutes()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 + 13 * 60, $time->addMinutes(13)->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 + 13 * 60, $time->addMinutes(13)->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13 * 60, $time->addMinutes(13)->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13 * 60, $time->addMinutes(13)->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::subMinutes()
     */
    public function testSubMinutes()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 - 13 * 60, $time->subMinutes(13)->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 - 13 * 60, $time->subMinutes(13)->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13 * 60, $time->subMinutes(13)->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13 * 60, $time->subMinutes(13)->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::addHours()
     */
    public function testAddHours()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 + 13 * 60 * 60, $time->addHours(13)->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 + 13 * 60 * 60, $time->addHours(13)->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13 * 60 * 60, $time->addHours(13)->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13 * 60 * 60, $time->addHours(13)->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::subHours()
     */
    public function testSubHours()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 - 13 * 60 * 60, $time->subHours(13)->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 - 13 * 60 * 60, $time->subHours(13)->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13 * 60 * 60, $time->subHours(13)->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13 * 60 * 60, $time->subHours(13)->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::addTime()
     */
    public function testAddTime()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 + 13, $time->setTime(61)->addTime(13)->getSeconds());
        $this->assertSame(61 + 13 * 60, $time->setTime(61)->addTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(61 + 13 * 60, $time->setTime(61)->addTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(61 + 13 * 60, $time->setTime(61)->addTime('13:00')->getSeconds());
        $this->assertSame(61 + 13 * 60 * 60, $time->setTime(61)->addTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(61 + 13 * 60 * 60, $time->setTime(61)->addTime('13:00:00')->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 + 13, $time->setTime('27:3')->addTime(13)->getSeconds());
        $this->assertSame(27 * 60 + 3 + 13 * 60,
            $time->setTime('27:3')->addTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(27 * 60 + 3 + 13 * 60, $time->setTime('27:3')->addTime('13:00')->getSeconds());
        $this->assertSame(27 * 60 + 3 + 13 * 60 * 60,
            $time->setTime('27:3')->addTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(27 * 60 + 3 + 13 * 60 * 60, $time->setTime('27:3')->addTime('13:00:00')->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13, $time->setTime('27:3', 'h:m')->addTime(13)->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13 * 60,
            $time->setTime('27:3', 'h:m')->addTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13 * 60,
            $time->setTime('27:3', 'h:m')->addTime('13:00')->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13 * 60 * 60,
            $time->setTime('27:3', 'h:m')->addTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 + 13 * 60 * 60,
            $time->setTime('27:3', 'h:m')->addTime('13:00:00')->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13, $time->setTime('13:27:3')->addTime(13)->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13 * 60,
            $time->setTime('13:27:3')->addTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13 * 60,
            $time->setTime('13:27:3')->addTime('13:00')->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13 * 60 * 60,
            $time->setTime('13:27:3')->addTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 + 13 * 60 * 60,
            $time->setTime('13:27:3')->addTime('13:00:00')->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::subTime()
     */
    public function testSubTime()
    {
        $time = new TimeFormatter(61);
        $this->assertSame(61 - 13, $time->setTime(61)->subTime(13)->getSeconds());
        $this->assertSame(61 - 13 * 60, $time->setTime(61)->subTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(61 - 13 * 60, $time->setTime(61)->subTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(61 - 13 * 60, $time->setTime(61)->subTime('13:00')->getSeconds());
        $this->assertSame(61 - 13 * 60 * 60, $time->setTime(61)->subTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(61 - 13 * 60 * 60, $time->setTime(61)->subTime('13:00:00')->getSeconds());

        $time = new TimeFormatter('27:3');
        $this->assertSame(27 * 60 + 3 - 13, $time->setTime('27:3')->subTime(13)->getSeconds());
        $this->assertSame(27 * 60 + 3 - 13 * 60,
            $time->setTime('27:3')->subTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(27 * 60 + 3 - 13 * 60, $time->setTime('27:3')->subTime('13:00')->getSeconds());
        $this->assertSame(27 * 60 + 3 - 13 * 60 * 60,
            $time->setTime('27:3')->subTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(27 * 60 + 3 - 13 * 60 * 60, $time->setTime('27:3')->subTime('13:00:00')->getSeconds());

        $time = new TimeFormatter('27:3', 'h:m');
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13, $time->setTime('27:3', 'h:m')->subTime(13)->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13 * 60,
            $time->setTime('27:3', 'h:m')->subTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13 * 60,
            $time->setTime('27:3', 'h:m')->subTime('13:00')->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13 * 60 * 60,
            $time->setTime('27:3', 'h:m')->subTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(27 * 60 * 60 + 3 * 60 - 13 * 60 * 60,
            $time->setTime('27:3', 'h:m')->subTime('13:00:00')->getSeconds());

        $time = new TimeFormatter('13:27:3');
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13, $time->setTime('13:27:3')->subTime(13)->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13 * 60,
            $time->setTime('13:27:3')->subTime(13, TimeFormatter::MINUTE)->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13 * 60,
            $time->setTime('13:27:3')->subTime('13:00')->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13 * 60 * 60,
            $time->setTime('13:27:3')->subTime(13, TimeFormatter::HOUR)->getSeconds());
        $this->assertSame(13 * 60 * 60 + 27 * 60 + 3 - 13 * 60 * 60,
            $time->setTime('13:27:3')->subTime('13:00:00')->getSeconds());
    }

    /**
     * Tests \Realejo\TimeFormatter::isTime()
     */
    public function testIsTime()
    {
        $this->assertTrue(TimeFormatter::isTime('13:27:30'));
        $this->assertTrue(TimeFormatter::isTime('13:27:3'));
        $this->assertTrue(TimeFormatter::isTime('13:2:3'));
        $this->assertTrue(TimeFormatter::isTime('1:2:3'));
        $this->assertTrue(TimeFormatter::isTime('27:3'));
        $this->assertTrue(TimeFormatter::isTime('27:30'));
        $this->assertTrue(TimeFormatter::isTime('3'));
        $this->assertTrue(TimeFormatter::isTime(3));

        $this->assertTrue(TimeFormatter::isTime('-13:27:30'));
        $this->assertTrue(TimeFormatter::isTime('-13:27:3'));
        $this->assertTrue(TimeFormatter::isTime('-13:2:3'));
        $this->assertTrue(TimeFormatter::isTime('-1:2:3'));
        $this->assertTrue(TimeFormatter::isTime('-27:3'));
        $this->assertTrue(TimeFormatter::isTime('-27:30'));
        $this->assertTrue(TimeFormatter::isTime('-3'));
        $this->assertTrue(TimeFormatter::isTime(-3));

        $this->assertFalse(TimeFormatter::isTime('13:27:3a'));
        $this->assertFalse(TimeFormatter::isTime('13:27a:3'));
        $this->assertFalse(TimeFormatter::isTime('13a:27:3'));
        $this->assertFalse(TimeFormatter::isTime('13a:2:3'));
        $this->assertFalse(TimeFormatter::isTime('13a:2:3'));
        $this->assertFalse(TimeFormatter::isTime('13:33:33:33'));
        $this->assertFalse(TimeFormatter::isTime(':27:3'));
        $this->assertFalse(TimeFormatter::isTime('13:27:'));
        $this->assertFalse(TimeFormatter::isTime('13::3'));

        $this->assertFalse(TimeFormatter::isTime('-13:27:3a'));
        $this->assertFalse(TimeFormatter::isTime('-13:27a:3'));
        $this->assertFalse(TimeFormatter::isTime('-13a:27:3'));
        $this->assertFalse(TimeFormatter::isTime('-13a:2:3'));
        $this->assertFalse(TimeFormatter::isTime('-13a:2:3'));
        $this->assertFalse(TimeFormatter::isTime('-13:33:33:33'));
        $this->assertFalse(TimeFormatter::isTime('-:27:3'));
        $this->assertFalse(TimeFormatter::isTime('-13:27:'));
        $this->assertFalse(TimeFormatter::isTime('-13::3'));

        $this->assertFalse(TimeFormatter::isTime('--13:27:30'));
        $this->assertFalse(TimeFormatter::isTime('--13:27:3'));
        $this->assertFalse(TimeFormatter::isTime('--13:2:3'));
        $this->assertFalse(TimeFormatter::isTime('--1:2:3'));
        $this->assertFalse(TimeFormatter::isTime('--27:3'));
        $this->assertFalse(TimeFormatter::isTime('--27:30'));
        $this->assertFalse(TimeFormatter::isTime('--3'));
    }

    /**
     * Testa criação da data com bastante segundos
     */
    public function testLogSeconds()
    {
        $time = new TimeFormatter('390526');
        $this->assertSame('108:28:46', $time->toString());
        $this->assertSame('46', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('28', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('108', $time->get(TimeFormatter::HOUR_SHORT));

        $time = new TimeFormatter(390526);
        $this->assertSame('46', $time->get(TimeFormatter::SECOND_SHORT));
        $this->assertSame('28', $time->get(TimeFormatter::MINUTE_SHORT));
        $this->assertSame('108', $time->get(TimeFormatter::HOUR_SHORT));
    }

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->RW_Time = new TimeFormatter(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->RW_Time = null;
        parent::tearDown();
    }
}
