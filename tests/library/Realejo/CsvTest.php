<?php
/**
 * Csv test case.
 *
 * @author     Realejo
 * @version    $Id: CPF.php 33 2012-06-19 14:18:04Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

use PHPUnit_Framework_TestCase;

require_once 'Realejo/Csv.php';

/**
 * Csv test case.
 */
class CsvTest extends PHPUnit_Framework_TestCase
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

