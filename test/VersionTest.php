<?php

namespace RealejoTest;

/**
 * Version test case.
 */

use PHPUnit\Framework\TestCase;
use Realejo\Version;

class VersionTest extends TestCase
{
    public function testGetLatest()
    {
        $this->assertNotEmpty(Version::getLatest());
    }

    public function testCompareVersion()
    {
        $this->assertEquals(0, Version::compareVersion(Version::VERSION));
        $this->assertContains(Version::compareVersion(Version::getLatest()), [-1, 0, 1]);
    }
}
