<?php

namespace RealejoTest;

/**
 * CPF test case.
 */

use PHPUnit\Framework\TestCase;
use Realejo\Cpf;

class CpfTest extends TestCase
{
    /**
     * Tests Cpf::unformat()
     */
    public function testUnformat()
    {
        $this->assertStringMatchesFormat('', Cpf::unformat(null));
        $this->assertStringMatchesFormat('', Cpf::unformat(''));
        $this->assertStringMatchesFormat('', Cpf::unformat('string'));

        $this->assertEquals(11, strlen(Cpf::unformat(1)));

        $this->assertStringMatchesFormat('00000000001', Cpf::unformat(1));
        $this->assertStringMatchesFormat('00000000001', Cpf::unformat('1'));
        $this->assertStringMatchesFormat('00000000012', Cpf::unformat('12'));
        $this->assertStringMatchesFormat('00000000123', Cpf::unformat('123'));
        $this->assertStringMatchesFormat('00000001234', Cpf::unformat('1234'));
        $this->assertStringMatchesFormat('00000012345', Cpf::unformat('12345'));
        $this->assertStringMatchesFormat('00000123456', Cpf::unformat('123456'));
        $this->assertStringMatchesFormat('00001234567', Cpf::unformat('1234567'));
        $this->assertStringMatchesFormat('00012345678', Cpf::unformat('12345678'));
        $this->assertStringMatchesFormat('00123456789', Cpf::unformat('123456789'));
        $this->assertStringMatchesFormat('01234567890', Cpf::unformat('1234567890'));
        $this->assertStringMatchesFormat('12345678901', Cpf::unformat('12345678901'));
        $this->assertStringMatchesFormat('12345678901', Cpf::unformat(12345678901));
    }

    /**
     * Tests Cpf::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Cpf::format(null));
        $this->assertEquals('', Cpf::format(''));
        $this->assertEquals('', Cpf::format('string'));

        $this->assertEquals(14, strlen(Cpf::format(1)));

        $this->assertStringMatchesFormat('000.000.000-01', Cpf::format(1));
        $this->assertStringMatchesFormat('000.000.000-01', Cpf::format('1'));
        $this->assertStringMatchesFormat('000.000.000-12', Cpf::format('12'));
        $this->assertStringMatchesFormat('000.000.001-23', Cpf::format('123'));
        $this->assertStringMatchesFormat('000.000.012-34', Cpf::format('1234'));
        $this->assertStringMatchesFormat('000.000.123-45', Cpf::format('12345'));
        $this->assertStringMatchesFormat('000.001.234-56', Cpf::format('123456'));
        $this->assertStringMatchesFormat('000.012.345-67', Cpf::format('1234567'));
        $this->assertStringMatchesFormat('000.123.456-78', Cpf::format('12345678'));
        $this->assertStringMatchesFormat('001.234.567-89', Cpf::format('123456789'));
        $this->assertStringMatchesFormat('012.345.678-90', Cpf::format('1234567890'));
        $this->assertStringMatchesFormat('123.456.789-01', Cpf::format('12345678901'));
        $this->assertStringMatchesFormat('123.456.789-01', Cpf::format(12345678901));

        $this->assertStringMatchesFormat('000.000.000-01', Cpf::format('00000000001'));
        $this->assertStringMatchesFormat('123.456.789-01', Cpf::format('12345678901'));
        $this->assertStringMatchesFormat('000.000.000-01', Cpf::format('000.000.000-01'));
        $this->assertStringMatchesFormat('123.456.789-01', Cpf::format('123.456.789-01'));
    }

    /**
     * Tests Cpf::isValid()
     * @see http://www.geradorcpf.com/
     */
    public function testValid()
    {
        $this->assertFalse(Cpf::isValid(null));
        $this->assertFalse(Cpf::isValid(''));
        $this->assertFalse(Cpf::isValid('string'));

        $this->assertFalse(Cpf::isValid('11111111111'));
        $this->assertFalse(Cpf::isValid('111.111.111-11'));
        $this->assertFalse(Cpf::isValid('22222222222'));
        $this->assertFalse(Cpf::isValid('33333333333'));
        $this->assertFalse(Cpf::isValid('44444444444'));
        $this->assertFalse(Cpf::isValid('55555555555'));
        $this->assertFalse(Cpf::isValid('66666666666'));
        $this->assertFalse(Cpf::isValid('77777777777'));
        $this->assertFalse(Cpf::isValid('88888888888'));
        $this->assertFalse(Cpf::isValid('99999999999'));

        $this->assertFalse(Cpf::isValid('123.456.789-01'));
        $this->assertFalse(Cpf::isValid('12345678901'));

        $this->assertTrue(Cpf::isValid('493.761.649-89'));
        $this->assertTrue(Cpf::isValid('49376164989'));
        $this->assertTrue(Cpf::isValid(49376164989));

        $this->assertTrue(Cpf::isValid('052.464.484-52'));
        $this->assertTrue(Cpf::isValid('52.464.484-52'));
        $this->assertTrue(Cpf::isValid('05246448452'));
        $this->assertTrue(Cpf::isValid('5246448452'));
        $this->assertTrue(Cpf::isValid(5246448452));
    }
}
