<?php

namespace RealejoTest;

/**
 * CNH test case.
 */
use Realejo\Cnh;

class CnhTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Cnh::unformat()
     */
    public function testUnformat()
    {
        $this->assertStringMatchesFormat('', Cnh::unformat(null));
        $this->assertStringMatchesFormat('', Cnh::unformat(''));
        $this->assertStringMatchesFormat('', Cnh::unformat('string'));

        $this->assertEquals(11, strlen(Cnh::unformat(1)));

        $this->assertStringMatchesFormat('00000000001', Cnh::unformat(1));
        $this->assertStringMatchesFormat('00000000001', Cnh::unformat('1'));
        $this->assertStringMatchesFormat('00000000012', Cnh::unformat('12'));
        $this->assertStringMatchesFormat('00000000123', Cnh::unformat('123'));
        $this->assertStringMatchesFormat('00000001234', Cnh::unformat('1234'));
        $this->assertStringMatchesFormat('00000012345', Cnh::unformat('12345'));
        $this->assertStringMatchesFormat('00000123456', Cnh::unformat('123456'));
        $this->assertStringMatchesFormat('00001234567', Cnh::unformat('1234567'));
        $this->assertStringMatchesFormat('00012345678', Cnh::unformat('12345678'));
        $this->assertStringMatchesFormat('00123456789', Cnh::unformat('123456789'));
        $this->assertStringMatchesFormat('01234567890', Cnh::unformat('1234567890'));
        $this->assertStringMatchesFormat('12345678901', Cnh::unformat('12345678901'));
        $this->assertStringMatchesFormat('12345678901', Cnh::unformat(12345678901));
    }

    /**
     * Tests Cnh::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Cnh::format(null));
        $this->assertEquals('', Cnh::format(''));
        $this->assertEquals('', Cnh::format('string'));

        $this->assertEquals(14, strlen(Cnh::format(1)));

        $this->assertStringMatchesFormat('000.000.000-01', Cnh::format(1));
        $this->assertStringMatchesFormat('000.000.000-01', Cnh::format('1'));
        $this->assertStringMatchesFormat('000.000.000-12', Cnh::format('12'));
        $this->assertStringMatchesFormat('000.000.001-23', Cnh::format('123'));
        $this->assertStringMatchesFormat('000.000.012-34', Cnh::format('1234'));
        $this->assertStringMatchesFormat('000.000.123-45', Cnh::format('12345'));
        $this->assertStringMatchesFormat('000.001.234-56', Cnh::format('123456'));
        $this->assertStringMatchesFormat('000.012.345-67', Cnh::format('1234567'));
        $this->assertStringMatchesFormat('000.123.456-78', Cnh::format('12345678'));
        $this->assertStringMatchesFormat('001.234.567-89', Cnh::format('123456789'));
        $this->assertStringMatchesFormat('012.345.678-90', Cnh::format('1234567890'));
        $this->assertStringMatchesFormat('123.456.789-01', Cnh::format('12345678901'));
        $this->assertStringMatchesFormat('123.456.789-01', Cnh::format(12345678901));

        $this->assertStringMatchesFormat('001.234.567-89', Cnh::format(123456789));
        $this->assertStringMatchesFormat('012.345.678-90', Cnh::format(1234567890));
        
        $this->assertStringMatchesFormat('000.000.000-01', Cnh::format('00000000001'));
        $this->assertStringMatchesFormat('123.456.789-01', Cnh::format('12345678901'));
        $this->assertStringMatchesFormat('000.000.000-01', Cnh::format('000.000.000-01'));
        $this->assertStringMatchesFormat('123.456.789-01', Cnh::format('123.456.789-01'));
    }

    /**
     * Tests Cnh::isValid()
     * @see https://www.4devs.com.br/gerador_de_cnh
     */
    public function testValid()
    {
        $this->assertFalse(Cnh::isValid(null));
        $this->assertFalse(Cnh::isValid(''));
        $this->assertFalse(Cnh::isValid('string'));

        $this->assertFalse(Cnh::isValid('11111111111'));
        $this->assertFalse(Cnh::isValid('111.111.111-11'));
        $this->assertFalse(Cnh::isValid('22222222222'));
        $this->assertFalse(Cnh::isValid('33333333333'));
        $this->assertFalse(Cnh::isValid('44444444444'));
        $this->assertFalse(Cnh::isValid('55555555555'));
        $this->assertFalse(Cnh::isValid('66666666666'));
        $this->assertFalse(Cnh::isValid('77777777777'));
        $this->assertFalse(Cnh::isValid('88888888888'));
        $this->assertFalse(Cnh::isValid('99999999999'));

        $this->assertFalse(Cnh::isValid('123.456.789-01'));
        $this->assertFalse(Cnh::isValid('12345678901'));

        $this->assertTrue(Cnh::isValid('392.585.233-96'));
        $this->assertTrue(Cnh::isValid('39258523396'));
        $this->assertTrue(Cnh::isValid(39258523396));

        $this->assertTrue(Cnh::isValid('21249574262'));
        $this->assertTrue(Cnh::isValid('212.495.742-62'));
        $this->assertTrue(Cnh::isValid(21249574262));
       
        $this->assertTrue(Cnh::isValid('079.025.093-54'));
        $this->assertTrue(Cnh::isValid('79.025.093-54'));
        $this->assertTrue(Cnh::isValid('07902509354'));
        $this->assertTrue(Cnh::isValid('7902509354'));
        $this->assertFalse(Cnh::isValid(07902509354)); 
        $this->assertTrue(Cnh::isValid(7902509354));
    
        $this->assertTrue(Cnh::isValid('960.302.638-07'));
        $this->assertTrue(Cnh::isValid('96030263807'));
        $this->assertTrue(Cnh::isValid(96030263807));
        
        $this->assertTrue(Cnh::isValid('015.190.508-78'));
        $this->assertTrue(Cnh::isValid('15.190.508-78'));
        $this->assertTrue(Cnh::isValid('01519050878'));
        $this->assertTrue(Cnh::isValid('1519050878'));
        $this->assertFalse(Cnh::isValid(01519050878)); 
        $this->assertTrue(Cnh::isValid(1519050878));
        
    }
}
