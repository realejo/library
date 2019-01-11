<?php

namespace RealejoTest;

/**
 * RG test case.
 */
use Realejo\Rg;

class RgTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Rg::unformat()
     */
    public function testUnformat()
    {
        $this->assertStringMatchesFormat('', Rg::unformat(null));
        $this->assertStringMatchesFormat('', Rg::unformat(''));
        $this->assertStringMatchesFormat('', Rg::unformat('string'));

        $this->assertEquals(9, strlen(Rg::unformat(1)));

        $this->assertStringMatchesFormat('000000001', Rg::unformat(1));
        $this->assertStringMatchesFormat('000000001', Rg::unformat('1'));
        $this->assertStringMatchesFormat('000000012', Rg::unformat('12'));
        $this->assertStringMatchesFormat('000000123', Rg::unformat('123'));
        $this->assertStringMatchesFormat('000001234', Rg::unformat('1234'));
        $this->assertStringMatchesFormat('000012345', Rg::unformat('12345'));
        $this->assertStringMatchesFormat('000123456', Rg::unformat('123456'));
        $this->assertStringMatchesFormat('001234567', Rg::unformat('1234567'));
        $this->assertStringMatchesFormat('012345678', Rg::unformat('12345678'));
        $this->assertStringMatchesFormat('123456789', Rg::unformat('123456789'));
        $this->assertStringMatchesFormat('234567890', Rg::unformat('234567890'));
        $this->assertStringMatchesFormat('345678901', Rg::unformat('345678901'));
        $this->assertStringMatchesFormat('345678901', Rg::unformat(345678901));
    }

    /**
     * Tests Rg::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Rg::format(null));
        $this->assertEquals('', Rg::format(''));
        $this->assertEquals('', Rg::format('string'));

        $this->assertEquals(12, strlen(Rg::format(1)));

        $this->assertStringMatchesFormat('00.000.000-1', Rg::format(1));
        $this->assertStringMatchesFormat('00.000.000-1', Rg::format('1'));
        $this->assertStringMatchesFormat('00.000.001-2', Rg::format('012'));
        $this->assertStringMatchesFormat('00.000.001-2', Rg::format('12'));
        $this->assertStringMatchesFormat('00.000.012-3', Rg::format('123'));
        $this->assertStringMatchesFormat('00.000.123-4', Rg::format('1234'));
        $this->assertStringMatchesFormat('00.001.234-5', Rg::format('12345'));
        $this->assertStringMatchesFormat('00.012.345-6', Rg::format('123456'));
        $this->assertStringMatchesFormat('00.123.456-7', Rg::format('1234567'));
        $this->assertStringMatchesFormat('01.234.567-8', Rg::format('12345678'));
        $this->assertStringMatchesFormat('12.345.678-9', Rg::format('123456789'));
        $this->assertStringMatchesFormat('23.456.789-0', Rg::format('234567890'));
        $this->assertStringMatchesFormat('23.456.789-0', Rg::format(234567890));

        $this->assertStringMatchesFormat('00.000.000-1', Rg::format('000000001'));
        $this->assertStringMatchesFormat('23.456.789-0', Rg::format('234567890'));
        $this->assertStringMatchesFormat('00.000.000-1', Rg::format('00.000.000-1'));
        $this->assertStringMatchesFormat('23.456.789-1', Rg::format('23.456.789-1'));
        
    }
    
    /**
     * Tests Rg::isValid()
     * @see https://www.4devs.com.br/gerador_de_rg
     */
    public function testValid()
    {
        $this->assertFalse(Rg::isValid(null));
        $this->assertFalse(Rg::isValid(''));
        $this->assertFalse(Rg::isValid('string'));
    
        $this->assertFalse(Rg::isValid('111111111'));
        $this->assertFalse(Rg::isValid('11.111.111-1'));
        $this->assertFalse(Rg::isValid('222222222'));
        $this->assertFalse(Rg::isValid('333333333'));
        $this->assertFalse(Rg::isValid('444444444'));
        $this->assertFalse(Rg::isValid('555555555'));
        $this->assertFalse(Rg::isValid('666666666'));
        $this->assertFalse(Rg::isValid('777777777'));
        $this->assertFalse(Rg::isValid('888888888'));
        $this->assertFalse(Rg::isValid('999999999'));

        $this->assertTrue(Rg::isValid('111111110'));
        $this->assertTrue(Rg::isValid('11.111.111-0'));
        $this->assertTrue(Rg::isValid('222222220'));
        $this->assertTrue(Rg::isValid('333333330'));
        $this->assertTrue(Rg::isValid('444444440'));
        $this->assertTrue(Rg::isValid('555555550'));
        $this->assertTrue(Rg::isValid('666666660'));
        $this->assertTrue(Rg::isValid('777777770'));
        $this->assertTrue(Rg::isValid('888888880'));
        $this->assertTrue(Rg::isValid('999999990'));
        
        $this->assertTrue(Rg::isValid('36.916.847-1'));
        $this->assertTrue(Rg::isValid('369168471'));
    
        $this->assertTrue(Rg::isValid('47.731.884-8'));
        $this->assertTrue(Rg::isValid('477318848'));
        $this->assertTrue(Rg::isValid(477318848));
    
        $this->assertFalse(Rg::isValid('206318628'));
        $this->assertFalse(Rg::isValid(206318628));
        $this->assertTrue(Rg::isValid('206318628', 'RJ'));
        $this->assertTrue(Rg::isValid(206318628, 'RJ'));
    }
}
