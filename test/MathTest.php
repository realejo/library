<?php

namespace RealejoTest;

/**
 * Math test case.
 */
use Realejo\Math;

class MathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Math::moda()
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function testModaInvalido1()
    {
        Math::moda(1);
    }

    /**
     * Tests Math::moda()
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function testModaInvalidoNull()
    {
        Math::moda(null);
    }

    /**
     * Tests Math::moda()
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function testModaInvalidoStdClass()
    {
        Math::moda(new \stdClass());
    }

    /**
     * Tests Math::moda()
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function testModaInvalidoString()
    {
        Math::moda('string');
    }

    /**
     * Tests Math::moda()
     */
    public function testModa()
    {
        // Valores válidos
        $this->assertTrue(count(Math::moda(array()))===0);
        $this->assertEquals(array(1),    Math::moda(array(1, 1, 2)));
        $this->assertEquals(array(1),    Math::moda(array(1, 1, 1, 2, 2, 3)));
        $this->assertEquals(array(1, 2), Math::moda(array(1, 2)));
        $this->assertEquals(array(1, 2), Math::moda(array(1, 1, 2, 2 )));
        $this->assertEquals(array(1, 2), Math::moda(array(1, 1, 2, 2, 3, 4)));
        $this->assertEquals(array(1, 2), Math::moda(array(1, 2, 1, 3, 4, 1, 2, 2, 3)));
    }

    /**
     * Tests Math::mediana()
     */
    public function testMediana()
    {
        // Valores inválidos
        $this->assertFalse(Math::mediana(array()));

        // Valores válidos
        $this->assertTrue(count(Math::moda(array()))===0);
        $this->assertEquals(1,   Math::mediana(array(1, 1, 2)));
        $this->assertEquals(1.5, Math::mediana(array(1, 1, 1, 2, 2, 3)));
        $this->assertEquals(1.5, Math::mediana(array(1, 2)));
        $this->assertEquals(1.5, Math::mediana(array(1, 1, 2, 2)));
        $this->assertEquals(2,   Math::mediana(array(1, 1, 2, 2, 3, 4)));
        $this->assertEquals(2,   Math::mediana(array(1, 2, 1, 3, 4, 1, 2, 2, 3)));
        $this->assertEquals(2,   Math::mediana(array(1, 2, 1, 3, 4, 1, 2, 2, 3), 'strcmp'));
    }
}
