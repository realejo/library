<?php

namespace RealejoTest;

/**
 * Cnpj test case.
 */

use PHPUnit\Framework\TestCase;
use Realejo\Cnpj;

class CnpjTest extends TestCase
{
    /**
     * Tests Cnpj::unformat()
     */
    public function testUnformat()
    {
        $this->assertEquals('', Cnpj::unformat(null));
        $this->assertEquals('', Cnpj::unformat(''));
        $this->assertEquals('', Cnpj::unformat('string'));

        $this->assertEquals(14, strlen(Cnpj::unformat(1)));

        $this->assertStringMatchesFormat('00000000000001', Cnpj::unformat(1));
        $this->assertStringMatchesFormat('00000000000001', Cnpj::unformat('1'));
        $this->assertStringMatchesFormat('00000000000012', Cnpj::unformat('12'));
        $this->assertStringMatchesFormat('00000000000123', Cnpj::unformat('123'));
        $this->assertStringMatchesFormat('00000000001234', Cnpj::unformat('1234'));
        $this->assertStringMatchesFormat('00000000012345', Cnpj::unformat('12345'));
        $this->assertStringMatchesFormat('00000000123456', Cnpj::unformat('123456'));
        $this->assertStringMatchesFormat('00000001234567', Cnpj::unformat('1234567'));
        $this->assertStringMatchesFormat('00000012345678', Cnpj::unformat('12345678'));
        $this->assertStringMatchesFormat('00000123456789', Cnpj::unformat('123456789'));
        $this->assertStringMatchesFormat('00001234567890', Cnpj::unformat('1234567890'));
        $this->assertStringMatchesFormat('00012345678901', Cnpj::unformat('12345678901'));
        $this->assertStringMatchesFormat('00123456789012', Cnpj::unformat('00123456789012'));
        $this->assertStringMatchesFormat('01234567890123', Cnpj::unformat('01234567890123'));
        $this->assertStringMatchesFormat('12345678901234', Cnpj::unformat('12345678901234'));
        $this->assertStringMatchesFormat('12345678901234', Cnpj::unformat(12345678901234));
    }

    /**
     * Tests Cnpj::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Cnpj::format(null));
        $this->assertEquals('', Cnpj::format(''));
        $this->assertEquals('', Cnpj::format('string'));

        $this->assertEquals(18, strlen(Cnpj::format(1)));

        $this->assertStringMatchesFormat('00.000.000/0000-01', Cnpj::format(1));
        $this->assertStringMatchesFormat('00.000.000/0000-01', Cnpj::format('1'));
        $this->assertStringMatchesFormat('00.000.000/0000-12', Cnpj::format('12'));
        $this->assertStringMatchesFormat('00.000.000/0001-23', Cnpj::format('123'));
        $this->assertStringMatchesFormat('00.000.000/0012-34', Cnpj::format('1234'));
        $this->assertStringMatchesFormat('00.000.000/0123-45', Cnpj::format('12345'));
        $this->assertStringMatchesFormat('00.000.000/1234-56', Cnpj::format('123456'));
        $this->assertStringMatchesFormat('00.000.001/2345-67', Cnpj::format('1234567'));
        $this->assertStringMatchesFormat('00.000.012/3456-78', Cnpj::format('12345678'));
        $this->assertStringMatchesFormat('00.000.123/4567-89', Cnpj::format('123456789'));
        $this->assertStringMatchesFormat('00.001.234/5678-90', Cnpj::format('1234567890'));
        $this->assertStringMatchesFormat('00.012.345/6789-01', Cnpj::format('12345678901'));
        $this->assertStringMatchesFormat('00.123.456/7890-12', Cnpj::format('00123456789012'));
        $this->assertStringMatchesFormat('01.234.567/8901-23', Cnpj::format('01234567890123'));
        $this->assertStringMatchesFormat('12.345.678/9012-34', Cnpj::format('12345678901234'));
        $this->assertStringMatchesFormat('12.345.678/9012-34', Cnpj::format(12345678901234));
    }

    /**
     * Tests Cnpj::isValid()
     * @see http://www.geradorcnpj.com/
     */
    public function testValid()
    {
        $this->assertFalse(Cnpj::isValid(null));
        $this->assertFalse(Cnpj::isValid(''));
        $this->assertFalse(Cnpj::isValid('string'));

        $this->assertFalse(Cnpj::isValid(1));
        $this->assertFalse(Cnpj::isValid('1'));

        $this->assertFalse(Cnpj::isValid('12.345.678/9012-34'));
        $this->assertFalse(Cnpj::isValid('12345678901234'));
        $this->assertFalse(Cnpj::isValid(12345678901234));

        $this->assertTrue(Cnpj::isValid('83.316.432/0001-33'));
        $this->assertTrue(Cnpj::isValid('83316432000133'));
        $this->assertTrue(Cnpj::isValid(83316432000133));

        $this->assertTrue(Cnpj::isValid('05.722.935/0001-03'));
        $this->assertTrue(Cnpj::isValid('05722935000103'));
        $this->assertTrue(Cnpj::isValid('5722935000103'));
        $this->assertTrue(Cnpj::isValid(5722935000103));
    }
}
