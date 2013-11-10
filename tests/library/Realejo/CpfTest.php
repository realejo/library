<?php
/**
 * Cpf test case.
 *
 * @author     Realejo
 * @version    $Id: CPF.php 33 2012-06-19 14:18:04Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

use PHPUnit_Framework_TestCase;

require_once 'Realejo/Cpf.php';

/**
 * Cpf test case.
 */
class CpfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cpf
     */
    private $Cpf;

    /**
     * Tests Cpf::unformat()
     */
    public function testUnformat ()
    {
        $this->assertEquals('', Cpf::unformat(null));
        $this->assertEquals('', Cpf::unformat(''));
        $this->assertEquals('', Cpf::unformat('string'));
        $this->assertEquals('00000000001', Cpf::unformat(1));
        $this->assertEquals('00000000001', Cpf::unformat('1'));
        $this->assertEquals('00000000012', Cpf::unformat('12'));
        $this->assertEquals('00000000123', Cpf::unformat('123'));
        $this->assertEquals('00000001234', Cpf::unformat('1234'));
        $this->assertEquals('00000012345', Cpf::unformat('12345'));
        $this->assertEquals('00000123456', Cpf::unformat('123456'));
        $this->assertEquals('00001234567', Cpf::unformat('1234567'));
        $this->assertEquals('00012345678', Cpf::unformat('12345678'));
        $this->assertEquals('00123456789', Cpf::unformat('123456789'));
        $this->assertEquals('01234567890', Cpf::unformat('1234567890'));
        $this->assertEquals('12345678901', Cpf::unformat('12345678901'));
        $this->assertEquals('12345678901', Cpf::unformat(12345678901));
    }

    /**
     * Tests Cpf::format()
     */
    public function testFormat ()
    {
        $this->assertEquals('', Cpf::format(null));
        $this->assertEquals('', Cpf::format(''));
        $this->assertEquals('', Cpf::format('string'));
        $this->assertEquals('000.000.000-01', Cpf::format(1));
        $this->assertEquals('000.000.000-01', Cpf::format('1'));
        $this->assertEquals('000.000.000-12', Cpf::format('12'));
        $this->assertEquals('000.000.001-23', Cpf::format('123'));
        $this->assertEquals('000.000.012-34', Cpf::format('1234'));
        $this->assertEquals('000.000.123-45', Cpf::format('12345'));
        $this->assertEquals('000.001.234-56', Cpf::format('123456'));
        $this->assertEquals('000.012.345-67', Cpf::format('1234567'));
        $this->assertEquals('000.123.456-78', Cpf::format('12345678'));
        $this->assertEquals('001.234.567-89', Cpf::format('123456789'));
        $this->assertEquals('012.345.678-90', Cpf::format('1234567890'));
        $this->assertEquals('123.456.789-01', Cpf::format('12345678901'));
        $this->assertEquals('123.456.789-01', Cpf::format(12345678901));

        $this->assertEquals('000.000.000-01', Cpf::format('00000000001'));
        $this->assertEquals('123.456.789-01', Cpf::format('12345678901'));
        $this->assertEquals('000.000.000-01', Cpf::format('000.000.000-01'));
        $this->assertEquals('123.456.789-01', Cpf::format('123.456.789-01'));

    }

    /**
     * Tests Cpf::valid()
     * @see http://www.geradorcpf.com/
     */
    public function testValid ()
    {
        $this->assertFalse(Cpf::valid(null));
        $this->assertFalse(Cpf::valid(''));
        $this->assertFalse(Cpf::valid('string'));


        $this->assertFalse(Cpf::valid('11111111111'));
        $this->assertFalse(Cpf::valid('22222222222'));
        $this->assertFalse(Cpf::valid('33333333333'));
        $this->assertFalse(Cpf::valid('44444444444'));
        $this->assertFalse(Cpf::valid('55555555555'));
        $this->assertFalse(Cpf::valid('66666666666'));
        $this->assertFalse(Cpf::valid('77777777777'));
        $this->assertFalse(Cpf::valid('88888888888'));
        $this->assertFalse(Cpf::valid('99999999999'));

        $this->assertFalse(Cpf::valid('123.456.789-01'));
        $this->assertFalse(Cpf::valid('12345678901'));

        $this->assertTrue(Cpf::valid('493.761.649-89'));
        $this->assertTrue(Cpf::valid('49376164989'));
        $this->assertTrue(Cpf::valid(49376164989));

        $this->assertTrue(Cpf::valid('052.464.484-52'));
        $this->assertTrue(Cpf::valid('52.464.484-52'));
        $this->assertTrue(Cpf::valid('05246448452'));
        $this->assertTrue(Cpf::valid('5246448452'));
        $this->assertTrue(Cpf::valid(5246448452));



    }

}

