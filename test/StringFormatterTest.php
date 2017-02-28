<?php

namespace RealejoTest;

use Realejo\StringFormatter;

/**
 * Test cases para o Realejo\StringFormatter
 */
class StringFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests StringFormatter::RemoveAcentos()
     */
    public function testRemoveAcentos()
    {
        $string  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝŸàáâãäåæçèéêëìíîïñòóôõöùúûüýÿ';
        $retorno = 'AAAAAAAECEEEEIIIINOOOOOUUUUYYaaaaaaaeceeeeiiiinooooouuuuyy';
        $this->assertEquals($retorno, StringFormatter::RemoveAcentos($string));
    }

    /**
     * Tests StringFormatter::strip_tags_attributes()
     */
    public function testStrip_tags_attributes()
    {
        //$allow = '<span><p><ul><li><b><strong><a>';
        $allow1 = '<span><a><p>';
        $allowAttributes1 = 'style';
        $str1 = '<p style="text-align:center">Paragraph</p><strong style="color:red">Bold</strong><br/>'
              . '<span style="color:red">Red</span><a href="#">Header</a>';
        $equals1 = '<p style_-_-"text-align:center">Paragraph</p>Bold<span style_-_-"color:red">Red</span>'
                 . '<a href="#">Header</a>';
        $this->assertEquals($equals1, StringFormatter::strip_tags_attributes($str1, $allow1, $allowAttributes1));

        $allow2 = '<span><p><ul><li><b><strong><a>';
        $allowAttributes = 'style';
        $str2 = '<p style="text-align:center">Paragraph</p><strong style="color:red">Bold</strong><br/>'
              . '<span style="color:red">Red</span><a style="color:red" href="#">Header</a>';
        $equals2 = '<p style_-_-"text-align:center">Paragraph</p><strong style_-_-"color:red">Bold</strong>'
                 . '<span style_-_-"color:red">Red</span><a style_-_-"color:red" href="#">Header</a>';
        $this->assertEquals($equals2, StringFormatter::strip_tags_attributes($str2, $allow2, $allowAttributes));
    }

    /**
     * Tests StringFormatter::CleanFileName()
     */
    public function testCleanFileName()
    {
        $filename = '#$%@#%$ãoçáàbácôíxêchôçú';
        $this->assertEquals('aocaabacoixechocu', StringFormatter::CleanFileName($filename));
    }

    /**
     * Tests StringFormatter::testSanitize()
     */
    public function testSanitize()
    {
        $this->assertEquals(
            'uma frase com aáeéiíoóuú e espaços',
            StringFormatter::sanitize("uma frase com aáeéiíoóuú e espaços")
        );
        $this->assertEquals('áéíóú123', StringFormatter::sanitize("áéíóú123"));
        $this->assertEquals('áéíóú123', StringFormatter::sanitize("áéíóú123\n"));

        // Array
        $teste = ['linha1' => 'áéíóú123-', 'linha2' => "áéíóú123\n", 'linha3' => "áéíóú123\n"];

        $resultado = ['linha1' => 'áéíóú123-', 'linha2' => "áéíóú123", 'linha3' => "áéíóú123"];
        $this->assertEquals($resultado, StringFormatter::sanitize($teste));

        $resultado = ['linha1' => 'áéíóú123-', 'linha2' => "áéíóú123\n", 'linha3' => "áéíóú123"];
        $this->assertEquals($resultado, StringFormatter::sanitize($teste, ['ignore' => 'linha2']));

        // Nomes com orkutify
        $this->assertEquals('Ana P.', StringFormatter::sanitize('Ana ▒ ▒ ▒ P.'));
        $this->assertEquals('Luiz M.', StringFormatter::sanitize('Luiz M. ♪♫'));
        $this->assertEquals('Luiz áéúíó M.', StringFormatter::sanitize('Luiz áéúíó M. ♪♫'));
        $this->assertEquals(
            'Thamyris Mendonça',
            StringFormatter::sanitize('•●๋• Thamyris Mendonça •●๋•')
        );
        $this->assertEquals('FERNANDA FIGHT', StringFormatter::sanitize('☠ FERNANDA FIGHT ☠ '));

        // Especiais
        $this->assertEquals('', StringFormatter::sanitize(null));
        $this->assertEquals('', StringFormatter::sanitize("\n"));

        // Caracteres escondidos ou inválidos
        $this->assertEquals('bigbob !', StringFormatter::sanitize('bigbob ­­ !')); // não é hifen!
        $this->assertEquals('bigbob!', StringFormatter::sanitize('bigbob­­!')); // não é hifen!
        $this->assertEquals('!!', StringFormatter::sanitize('!­­!')); // não é hifen!
        $this->assertEquals('!--!', StringFormatter::sanitize('!--!')); // é hifen!
    }

    /**
     * Tests StringFormatter::seourl()
     */
    public function testGetSlug()
    {
        $url        = 'fazendo uma tremenda bagunça e uma GRANDE confusão';
        $urlRetorno = 'fazendo-uma-tremenda-bagunca-e-uma-grande-confusao';
        $this->assertEquals($urlRetorno, StringFormatter::getSlug($url));

        // A partir do PHP 5.4 o enconding padrão é o UTF-8
        //@todo verificar se precisa testar outra coisa diferente
        if (PHP_MAJOR_VERSION === 5 && PHP_MINOR_VERSION === 3) {
            $url        = utf8_decode('fazendo uma tremenda bagunça e uma GRANDE confusão');
            $urlRetorno = 'fazendo-uma-tremenda-bagunca-e-uma-grande-confusao';
            $this->assertEquals($urlRetorno, StringFormatter::getSlug($url));
        }
    }

    /**
     * Tests StringFormatter::getSafeSEO()
     */
    public function testGetSafeSlug()
    {
        $this->assertEquals('123-bla,blsdsa-bla', StringFormatter::getSafeSlug(' 123-bla,blsds   a-bla '));
    }

    /**
     * Tests StringFormatter::getSEOID()
     */
    public function testGetSlugId()
    {
        $this->assertEquals('123', StringFormatter::getSlugId('123-bla,bla-bla'));
        $this->assertEquals('123', StringFormatter::getSlugId('123,bla-bla-bla'));

        $this->assertEquals('123', StringFormatter::getSlugId('123-bla-bla-bla', '-'));
        $this->assertEquals('123', StringFormatter::getSlugId('123 -b la - b la - b l a ', '-'));
        $this->assertEquals('123-bla-bla-bla', StringFormatter::getSlugId('123-bla-bla-bla', ','));
        $this->assertEquals('123-bla', StringFormatter::getSlugId('123-bla,bla-bla', ','));

        $this->assertEquals('agora', StringFormatter::getSlugId('ágora-sim', '-'));
    }

    /**
     * Tests StringFormatter::CleanHTML()
     */
    public function testCleanHTML()
    {
        $allow   = '<span><a><br>';
        $str     = '<p style="text-align:center">Paragraph</p><strong style="color:red">Bold</strong><br>'
                 . '<span style="color:red">Red</span><a href="#">Header</a>';
        $retorno = 'ParagraphBold<br><span style="color:red">Red</span><a href="#">Header</a>';
        $this->assertEquals($retorno, StringFormatter::cleanHTML($str, $allow));
    }
}
