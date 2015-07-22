<?php

namespace RealejoTest;

/**
 * Csv test case.
 */
use Realejo\Csv;

class CsvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests RW_Base::getCSV()
     */
    public function testGetCSV ()
    {
        $array[0] = array('nome'=>'Artur dos Santos','idade'=>32,'data_nascimento'=>'28/08/1979','escolaridade'=>'2 Grau');
        $retorno1  = "NOME;IDADE;DATA_NASCIMENTO;ESCOLARIDADE\n\"Artur dos Santos\";\"32\";\"28/08/1979\";\"2 Grau\"";
        $retorno2  = "NOME;IDADE;DATA_NASCIMENTO\n\"Artur dos Santos\";\"32\";\"28/08/1979\"";
        $retorno3  = "NOME;IDADE;DATA_NASCIMENTO\n\"Artur dos Santos\";\"32\";\"28/08/1979\"";
        $this->assertEquals($retorno1, Csv::getCSV($array,null));
        $this->assertEquals($retorno2, Csv::getCSV($array,'escolaridade'));
        $this->assertEquals($retorno3, Csv::getCSV($array,array('escolaridade')));
    }
}

