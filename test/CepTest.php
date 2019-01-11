<?php

namespace RealejoTest;

/**
 * CEP test case.
 */

use PHPUnit\Framework\TestCase;
use Realejo\Cep;

class CepTest extends TestCase
{
    /**
     * Tests Cep::unformat()
     */
    public function testUnformat()
    {
        $this->assertStringMatchesFormat('', Cep::unformat(null));
        $this->assertStringMatchesFormat('', Cep::unformat(''));
        $this->assertStringMatchesFormat('', Cep::unformat('string'));

        $this->assertEquals(8, strlen(Cep::unformat(1)));

        $this->assertStringMatchesFormat('00000001', Cep::unformat(1));
        $this->assertStringMatchesFormat('00000001', Cep::unformat('1'));
        $this->assertStringMatchesFormat('00000012', Cep::unformat('12'));
        $this->assertStringMatchesFormat('00000123', Cep::unformat('123'));
        $this->assertStringMatchesFormat('00001234', Cep::unformat('1234'));
        $this->assertStringMatchesFormat('00012345', Cep::unformat('12345'));
        $this->assertStringMatchesFormat('00123456', Cep::unformat('123456'));
        $this->assertStringMatchesFormat('01234567', Cep::unformat('1234567'));
        $this->assertStringMatchesFormat('12345678', Cep::unformat('12345678'));
        $this->assertStringMatchesFormat('23456789', Cep::unformat('23456789'));
        $this->assertStringMatchesFormat('34567890', Cep::unformat('34567890'));
        $this->assertStringMatchesFormat('45678901', Cep::unformat('45678901'));
        $this->assertStringMatchesFormat('45678901', Cep::unformat(45678901));
    }

    /**
     * Tests Cep::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Cep::format(null));
        $this->assertEquals('', Cep::format(''));
        $this->assertEquals('', Cep::format('string'));

        $this->assertEquals(9, strlen(Cep::format(1)));

        $this->assertStringMatchesFormat('00000-001', Cep::format(1));
        $this->assertStringMatchesFormat('00000-001', Cep::format('1'));
        $this->assertStringMatchesFormat('00000-012', Cep::format('12'));
        $this->assertStringMatchesFormat('00000-123', Cep::format('123'));
        $this->assertStringMatchesFormat('00001-234', Cep::format('1234'));
        $this->assertStringMatchesFormat('00012-345', Cep::format('12345'));
        $this->assertStringMatchesFormat('00123-456', Cep::format('123456'));
        $this->assertStringMatchesFormat('01234-567', Cep::format('1234567'));
        $this->assertStringMatchesFormat('12345-678', Cep::format('12345678'));
        $this->assertStringMatchesFormat('23456-789', Cep::format('23456789'));
        $this->assertStringMatchesFormat('34567-890', Cep::format('34567890'));
        $this->assertStringMatchesFormat('45678-901', Cep::format('45678901'));
        $this->assertStringMatchesFormat('45678-901', Cep::format(45678901));

        $this->assertStringMatchesFormat('00000-001', Cep::format('00000001'));
        $this->assertStringMatchesFormat('45678-901', Cep::format('45678901'));
        $this->assertStringMatchesFormat('00000-001', Cep::format('00000-001'));
        $this->assertStringMatchesFormat('45678-901', Cep::format('45678-901'));
    }
}
