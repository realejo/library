<?php

namespace RealejoTest;

/**
 * File test case.
 */
use Realejo\File;

class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests File::readfileChunked()
     */
    public function testReadfileChunked()
    {
        $filePath = realpath(__DIR__ . '/_files') . '/testFile.txt';
        $this->assertTrue(file_exists($filePath), "Arquivo de teste não existe");
        ob_start();
        $this->assertEquals(31, File::readfileChunked($filePath));
        ob_end_clean();
    }
}
