<?php
use Realejo\Version;

/**
 * Version test case.
 */
class VersionTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Version
     */
    private $Version;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();

        // TODO Auto-generated VersionTest::setUp()

        $this->Version = new Version(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated VersionTest::tearDown()
        $this->Version = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Version::compareVersion()
     */
    public function testCompareVersion ()
    {
        // TODO Auto-generated VersionTest::testCompareVersion()
        $this->markTestIncomplete("compareVersion test not implemented");

        Version::compareVersion(/* parameters */);
    }

    /**
     * Tests Version::getLatest()
     */
    public function testGetLatest ()
    {
        // TODO Auto-generated VersionTest::testGetLatest()
        $this->markTestIncomplete("getLatest test not implemented");

        Version::getLatest(/* parameters */);
    }
}

