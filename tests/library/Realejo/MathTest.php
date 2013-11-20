<?php
/**
 * Math test case.
 *
 * @author     Realejo
 * @version    $Id: CPF.php 33 2012-06-19 14:18:04Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

use PHPUnit_Framework_TestCase;

require_once 'Realejo/Math.php';

class MathTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests Math::moda()
     */
    public function testModa()
    {
        // Valores inválidos
        // @todo como testar exceptions?
        //$this->getExpectedException(Math::moda(1));
        //$this->getExpectedException(Math::moda(null));
        //$this->getExpectedException(Math::moda(new stdClass()));
        //$this->getExpectedException(Math::moda('oi'));

        // Valores válidos
        $this->assertTrue(count(Math::moda(array()))===0);
        $this->assertEquals(array(1),   Math::moda(array(1,1,2)));
        $this->assertEquals(array(1),   Math::moda(array(1,1,1,2,2,3)));
        $this->assertEquals(array(1,2), Math::moda(array(1,2)));
        $this->assertEquals(array(1,2), Math::moda(array(1,1,2,2)));
        $this->assertEquals(array(1,2), Math::moda(array(1,1,2,2,3,4)));
        $this->assertEquals(array(1,2), Math::moda(array(1,2,1,3,4,1,2,2,3)));
    }
    /**
     * Tests Math::mediana()
     */
    public function testMediana()
    {
        // Valores inválidos
        // @todo como testar exceptions?
        $this->assertFalse(Math::mediana(array()));

        // Valores válidos
        $this->assertTrue(count(Math::moda(array()))===0);
        $this->assertEquals(1,   Math::mediana(array(1,1,2)));
        $this->assertEquals(1.5, Math::mediana(array(1,1,1,2,2,3)));
        $this->assertEquals(1.5, Math::mediana(array(1,2)));
        $this->assertEquals(1.5, Math::mediana(array(1,1,2,2)));
        $this->assertEquals(2,   Math::mediana(array(1,1,2,2,3,4)));
        $this->assertEquals(2,   Math::mediana(array(1,2,1,3,4,1,2,2,3)));
        $this->assertEquals(2,   Math::mediana(array(1,2,1,3,4,1,2,2,3),'strcmp'));
    }
}

