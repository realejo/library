<?php

namespace RealejoTest;

/**
 * CREA test case.
 */
use Realejo\Crea;

class CreaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Crea::unformat()
     */
    public function testUnformat()
    {
        $this->assertStringMatchesFormat('', Crea::unformat(null));
        $this->assertStringMatchesFormat('', Crea::unformat(''));
        $this->assertStringMatchesFormat('', Crea::unformat('string'));

        $this->assertEquals(10, strlen(Crea::unformat(1)));

        $this->assertStringMatchesFormat('0000000001', Crea::unformat(1));
        $this->assertStringMatchesFormat('0000000001', Crea::unformat('1'));
        $this->assertStringMatchesFormat('0000000012', Crea::unformat('12'));
        $this->assertStringMatchesFormat('0000000123', Crea::unformat('123'));
        $this->assertStringMatchesFormat('0000001234', Crea::unformat('1234'));
        $this->assertStringMatchesFormat('0000012345', Crea::unformat('12345'));
        $this->assertStringMatchesFormat('0000123456', Crea::unformat('123456'));
        $this->assertStringMatchesFormat('0001234567', Crea::unformat('1234567'));
        $this->assertStringMatchesFormat('0012345678', Crea::unformat('12345678'));
        $this->assertStringMatchesFormat('0123456789', Crea::unformat('123456789'));
        $this->assertStringMatchesFormat('1234567890', Crea::unformat('1234567890'));
        $this->assertStringMatchesFormat('2345678901', Crea::unformat('2345678901'));
        $this->assertStringMatchesFormat('2345678901', Crea::unformat(2345678901));
    }

    /**
     * Tests Crea::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Crea::format(null));
        $this->assertEquals('', Crea::format(''));
        $this->assertEquals('', Crea::format('string'));

        $this->assertEquals(11, strlen(Crea::format(1)));

        $this->assertStringMatchesFormat('000000000-1', Crea::format(1));
        $this->assertStringMatchesFormat('000000000-1', Crea::format('1'));
        $this->assertStringMatchesFormat('000000001-2', Crea::format('012'));
        $this->assertStringMatchesFormat('000000001-2', Crea::format('12'));
        $this->assertStringMatchesFormat('000000012-3', Crea::format('123'));
        $this->assertStringMatchesFormat('000000123-4', Crea::format('1234'));
        $this->assertStringMatchesFormat('000001234-5', Crea::format('12345'));
        $this->assertStringMatchesFormat('000012345-6', Crea::format('123456'));
        $this->assertStringMatchesFormat('000123456-7', Crea::format('1234567'));
        $this->assertStringMatchesFormat('001234567-8', Crea::format('12345678'));
        $this->assertStringMatchesFormat('012345678-9', Crea::format('123456789'));
        $this->assertStringMatchesFormat('012345678-9', Crea::format('0123456789'));
        $this->assertStringMatchesFormat('123456789-0', Crea::format('1234567890'));
        $this->assertStringMatchesFormat('123456789-0', Crea::format(1234567890));

        $this->assertStringMatchesFormat('000000000-1', Crea::format('0000000001'));
        $this->assertStringMatchesFormat('123456789-0', Crea::format('1234567890'));
        $this->assertStringMatchesFormat('000000000-1', Crea::format('000000000-1'));
        $this->assertStringMatchesFormat('123456789-1', Crea::format('123456789-1'));
        
    }
}
