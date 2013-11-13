<?php
/**
 * File test case.
 *
 * @author     Realejo
 * @version    $Id: CPF.php 33 2012-06-19 14:18:04Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

use PHPUnit_Framework_TestCase;

require_once 'Realejo/File.php';

class FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests File::readfileChunked()
     */
    public function testReadfileChunked()
    {
    	$filePath = realpath(__DIR__ . '/../../assets/') . '/testFile.txt';
    	$this->assertTrue(file_exists($filePath), "Arquivo de teste não existe");
    	ob_start();
        $this->assertEquals(31, File::readfileChunked($filePath));
        ob_end_clean();
    }
}

