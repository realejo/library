<?php

namespace RealejoTest;

/**
 * Phone test case.
 */
use Realejo\Phone;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Phone::unformat()
     */
    public function testUnformat()
    {
        $this->assertStringMatchesFormat('', Phone::unformat(null));
        $this->assertStringMatchesFormat('', Phone::unformat(''));
        $this->assertStringMatchesFormat('', Phone::unformat('string'));

        $this->assertStringMatchesFormat('34567890', Phone::unformat('3456-7890'));
        $this->assertStringMatchesFormat('45678901', Phone::unformat('45678901'));
        $this->assertStringMatchesFormat('56789012', Phone::unformat('5678-9012'));
        $this->assertStringMatchesFormat('67890123', Phone::unformat('6789-0123'));
        $this->assertStringMatchesFormat('67890123', Phone::unformat(67890123));

        $this->assertStringMatchesFormat('934567890', Phone::unformat('93456-7890'));
        $this->assertStringMatchesFormat('945678901', Phone::unformat('945678901'));
        $this->assertStringMatchesFormat('956789012', Phone::unformat('95678-9012'));
        $this->assertStringMatchesFormat('967890123', Phone::unformat('96789-0123'));
        $this->assertStringMatchesFormat('967890123', Phone::unformat(967890123));

        $this->assertStringMatchesFormat('1234567890', Phone::unformat('(12) 3456-7890'));
        $this->assertStringMatchesFormat('2345678901', Phone::unformat('(23) 45678901'));
        $this->assertStringMatchesFormat('3456789012', Phone::unformat('34 5678-9012'));
        $this->assertStringMatchesFormat('4567890123', Phone::unformat('456789-0123'));
        $this->assertStringMatchesFormat('4567890123', Phone::unformat(4567890123));

        $this->assertStringMatchesFormat('12934567890', Phone::unformat('(12) 93456-7890'));
        $this->assertStringMatchesFormat('23945678901', Phone::unformat('(23) 945678901'));
        $this->assertStringMatchesFormat('34956789012', Phone::unformat('34 95678-9012'));
        $this->assertStringMatchesFormat('45967890123', Phone::unformat('4596789-0123'));
        $this->assertStringMatchesFormat('45967890123', Phone::unformat(45967890123));

        $this->assertStringMatchesFormat('551234567890', Phone::unformat('55 (12) 3456-7890'));
        $this->assertStringMatchesFormat('552345678901', Phone::unformat('55 (23) 45678901'));
        $this->assertStringMatchesFormat('553456789012', Phone::unformat('55 34 5678-9012'));
        $this->assertStringMatchesFormat('554567890123', Phone::unformat('55456789-0123'));
        $this->assertStringMatchesFormat('554567890123', Phone::unformat(554567890123));

        $this->assertStringMatchesFormat('5512934567890', Phone::unformat('55 (12) 93456-7890'));
        $this->assertStringMatchesFormat('5523945678901', Phone::unformat('55 (23) 945678901'));
        $this->assertStringMatchesFormat('5534956789012', Phone::unformat('55 34 95678-9012'));
        $this->assertStringMatchesFormat('5545967890123', Phone::unformat('554596789-0123'));
        $this->assertStringMatchesFormat('5545967890123', Phone::unformat(5545967890123));
    }

    /**
     * Tests Phone::format()
     */
    public function testFormat()
    {
        $this->assertEquals('', Phone::format(null));
        $this->assertEquals('', Phone::format(''));
        $this->assertEquals('', Phone::format('string'));

        $this->assertStringMatchesFormat('3456-7890', Phone::format('34567890'));
        $this->assertStringMatchesFormat('4567-8901', Phone::format('45678901'));
        $this->assertStringMatchesFormat('5678-9012', Phone::format('56789012'));
        $this->assertStringMatchesFormat('6789-0123', Phone::format('67890123'));
        $this->assertStringMatchesFormat('6789-0123', Phone::format(67890123));

        $this->assertStringMatchesFormat('93456-7890', Phone::format('934567890', true));
        $this->assertStringMatchesFormat('94567-8901', Phone::format('945678901', true));
        $this->assertStringMatchesFormat('95678-9012', Phone::format('956789012', true));
        $this->assertStringMatchesFormat('96789-0123', Phone::format('967890123', true));
        $this->assertStringMatchesFormat('96789-0123', Phone::format(967890123, true));

        $this->assertStringMatchesFormat('(12) 3456-7890', Phone::format('1234567890'));
        $this->assertStringMatchesFormat('(23) 4567-8901', Phone::format('2345678901'));
        $this->assertStringMatchesFormat('(34) 5678-9012', Phone::format('3456789012'));
        $this->assertStringMatchesFormat('(45) 6789-0123', Phone::format('4567890123'));
        $this->assertStringMatchesFormat('(45) 6789-0123', Phone::format(4567890123));

        $this->assertStringMatchesFormat('(12) 93456-7890', Phone::format('12934567890', true));
        $this->assertStringMatchesFormat('(23) 94567-8901', Phone::format('23945678901', true));
        $this->assertStringMatchesFormat('(34) 95678-9012', Phone::format('34956789012', true));
        $this->assertStringMatchesFormat('(45) 96789-0123', Phone::format('45967890123', true));
        $this->assertStringMatchesFormat('(45) 96789-0123', Phone::format(45967890123, true));


        $this->assertStringMatchesFormat('55 (12) 3456-7890', Phone::format('551234567890'));
        $this->assertStringMatchesFormat('55 (23) 4567-8901', Phone::format('552345678901'));
        $this->assertStringMatchesFormat('55 (34) 5678-9012', Phone::format('553456789012'));
        $this->assertStringMatchesFormat('55 (45) 6789-0123', Phone::format('554567890123'));
        $this->assertStringMatchesFormat('55 (45) 6789-0123', Phone::format(554567890123));

        $this->assertStringMatchesFormat('55 (12) 93456-7890', Phone::format('5512934567890', true));
        $this->assertStringMatchesFormat('55 (23) 94567-8901', Phone::format('5523945678901', true));
        $this->assertStringMatchesFormat('55 (34) 95678-9012', Phone::format('5534956789012', true));
        $this->assertStringMatchesFormat('55 (45) 96789-0123', Phone::format('5545967890123', true));
        $this->assertStringMatchesFormat('55 (45) 96789-0123', Phone::format(5545967890123, true));
    }
}
