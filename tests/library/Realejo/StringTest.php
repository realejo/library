<?php
/**
 * String test case.
 *
 * @author     Realejo
 * @version    $Id: CPF.php 33 2012-06-19 14:18:04Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

use PHPUnit_Framework_TestCase;

require_once 'Realejo/String.php';

/**
 * String test case.
 */
class StringTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests String::RemoveAcentos()
     */
    public function testRemoveAcentos ()
    {
        $string  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝŸàáâãäåæçèéêëìíîïñòóôõöùúûüýÿ';
        $retorno = 'AAAAAAAECEEEEIIIINOOOOOUUUUYYaaaaaaaeceeeeiiiinooooouuuuyy';
        $this->assertEquals($retorno, String::RemoveAcentos($string));
    }

    /**
     * Tests String::strip_tags_attributes()
     */
    public function testStrip_tags_attributes ()
    {
        //$allow = '<span><p><ul><li><b><strong><a>';
        $allow1 = '<span><a><p>';
        $allowatributs1 = 'style';
        $str1 = '<p style="text-align:center">Paragraph</p><strong style="color:red">Bold</strong><br/><span style="color:red">Red</span><a href="#">Header</a>';
        $equals1 = '<p style_-_-"text-align:center">Paragraph</p>Bold<span style_-_-"color:red">Red</span><a href="#">Header</a>';
        $this->assertEquals($equals1, String::strip_tags_attributes($str1,$allow1,$allowatributs1));

        $allow2 = '<span><p><ul><li><b><strong><a>';
        $allowatributs2 = 'style';
        $str2 = '<p style="text-align:center">Paragraph</p><strong style="color:red">Bold</strong><br/><span style="color:red">Red</span><a style="color:red" href="#">Header</a>';
        $equals2 = '<p style_-_-"text-align:center">Paragraph</p><strong style_-_-"color:red">Bold</strong><span style_-_-"color:red">Red</span><a style_-_-"color:red" href="#">Header</a>';
        $this->assertEquals($equals2, String::strip_tags_attributes($str2,$allow2,$allowatributs2));
    }

    /**
     * Tests String::CleanFileName()
     */
    public function testCleanFileName ()
    {
        $filename = '#$%@#%$ãoçáàbácôíxêchôçú';
        $this->assertEquals('aocaabacoixechocu', String::CleanFileName($filename));
    }

    /**
     * Tests String::testSanitize()
     */
    public function testSanitize()
    {
        $this->assertEquals("uma frase com aáeéiíoóuú e espaços",String::sanitize("uma frase com aáeéiíoóuú e espaços"));
        $this->assertEquals("áéíóú123",String::sanitize("áéíóú123"));
        $this->assertEquals("áéíóú123",String::sanitize("áéíóú123\n"));

        // Array
        $teste = array('linha1'=>"áéíóú123-", 'linha2'=> "áéíóú123\n", 'linha3'=> "áéíóú123\n");

        $resultado = array('linha1'=>"áéíóú123-", 'linha2'=> "áéíóú123", 'linha3'=> "áéíóú123");
        $this->assertEquals($resultado,String::sanitize($teste));

        $resultado = array('linha1'=>"áéíóú123-", 'linha2'=> "áéíóú123\n", 'linha3'=> "áéíóú123");
        $this->assertEquals($resultado,String::sanitize($teste,array('ignore'=>'linha2')));

        // Nomes com orkutify
        $this->assertEquals('Ana P.',String::sanitize('Ana ▒ ▒ ▒ P.'));
        $this->assertEquals('Luiz M.',String::sanitize('Luiz M. ♪♫'));
        $this->assertEquals('Luiz áéúíó M.',String::sanitize('Luiz áéúíó M. ♪♫'));
        $this->assertEquals('Thamyris Mendonça',String::sanitize('•●๋• Thamyris Mendonça •●๋•'));
        $this->assertEquals('FERNANDA FIGHT',String::sanitize('☠ FERNANDA FIGHT ☠ '));

        // Especiais
        $this->assertEquals('',String::sanitize(null));
        $this->assertEquals('',String::sanitize("\n"));

        // Caracteres escondidos ou inválidos
        $this->assertEquals("bigbob !",String::sanitize("bigbob ­­ !")); // não é hifen!
        $this->assertEquals("bigbob!",String::sanitize("bigbob­­!")); // não é hifen!
        $this->assertEquals("!!",String::sanitize("!­­!")); // não é hifen!
        $this->assertEquals("!--!",String::sanitize("!--!")); // é hifen!
    }

    /**
     * Tests String::seourl()
     */
    public function testGetSlug()
    {
        $url        = 'fazendo uma tremenda bagunça e uma GRANDE confusão';
        $urlRetorno = 'fazendo-uma-tremenda-bagunca-e-uma-grande-confusao';
        $this->assertEquals($urlRetorno, String::getSlug($url));


        // A partir do PHP 5.4 o enconding padrão é o UTF-8
        if (PHP_MAJOR_VERSION === 5 && PHP_MINOR_VERSION == 2) {
            $url    = utf8_decode('fazendo uma tremenda bagunça e uma GRANDE confusão');
        } else {
            $url    = iconv('UTF-8', 'ISO-8859-1', 'fazendo uma tremenda bagunça e uma GRANDE confusão');
        }
        $urlRetorno = 'fazendo-uma-tremenda-bagunca-e-uma-grande-confusao';
        $this->assertEquals($urlRetorno, String::getSlug($url));
    }

    /**
     * Tests String::getSafeSEO()
     */
    public function testGetSafeSlug()
    {
        $this->assertEquals('123-bla,blsdsa-bla', String::getSafeSlug(' 123-bla,blsds   a-bla '));
    }

    /**
     * Tests String::getSEOID()
     */
    public function testGetSlugId ()
    {
        $this->assertEquals('123', String::getSlugId('123-bla,bla-bla'));
        $this->assertEquals('123', String::getSlugId('123,bla-bla-bla'));

        $this->assertEquals('123', String::getSlugId('123-bla-bla-bla', '-'));
        $this->assertEquals('123', String::getSlugId('123 -b la - b la - b l a ', '-'));
        $this->assertEquals('123-bla-bla-bla', String::getSlugId('123-bla-bla-bla', ','));
        $this->assertEquals('123-bla', String::getSlugId('123-bla,bla-bla',','));

        $this->assertEquals('agora', String::getSlugId('ágora-sim', '-'));
    }

    /**
     * Tests String::CleanHTML()
     */
    public function testCleanHTML ()
    {
        $allow   = '<span><a><br>';
        $str     = '<p style="text-align:center">Paragraph</p><strong style="color:red">Bold</strong><br><span style="color:red">Red</span><a href="#">Header</a>';
        $retorno = 'ParagraphBold<br><span style="color:red">Red</span><a href="#">Header</a>';
        $this->assertEquals($retorno, String::CleanHTML($str,$allow));
    }
}
