<?php
/**
 * Image test case.
 *
 * @author     Realejo
 * @version    $Id: CPF.php 33 2012-06-19 14:18:04Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http:// www.realejo.com.br)
 */
namespace Realejo;

use PHPUnit_Framework_TestCase;

require_once 'Realejo/Image.php';

class ImageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RW_Image
     */
    private $Image;

    /**
     * @var string
     */
    private $imgPath;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->Image = new Image(/* parameters */);

        // path para as imagens
        $this->imgPath = realpath(__DIR__ . '/../../assets/');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated ImageTest::tearDown()
        $this->Image = null;
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
     * Tests RW_Image->__construct()
     */
    public function test__construct ()
    {
        // TODO Auto-generated ImageTest->test__construct()
       // $this->markTestIncomplete("__construct test not implemented");
        $this->Image->__construct(/* parameters */);
    }
    /**
     * Tests RW_Image->open()
     */
    public function testOpen ()
    {
        // Abrir JPG
        $file = $this->imgPath.'/exemplo.jpg';
        $this->assertTrue($this->Image->open($file));
        // Verifica se foi criado o resource
        $this->assertTrue($this->Image->isLoaded());

        // Verifica se o mimetype é JPEG
        $mineType = $this->Image->mimeType;
        $this->assertEquals('jpeg', $mineType);

        // Fecha a imagem
        $this->Image->close();

        // Abrir arquivo inexistente
		$file = $this->imgPath.'/naoexiste.jpg';
		$this->assertFalse($this->Image->open($file));

        // Abrir PNG
		$file = $this->imgPath.'/exemplo.png';
		$this->assertTrue($this->Image->open($file));

		// Verifica se foi criado o resource
		$this->assertTrue($this->Image->isLoaded());

		// Verifica se o mimetype é PNG
		$mineType = $this->Image->mimeType;
        // $this->assertEqual('png',$mineType);
        $this->assertTrue('png' === $mineType);

        // Fecha a imagem
        $this->Image->close();

		// Abrir GIF
		$file = $this->imgPath.'/exemplo.gif';
		$this->assertTrue($this->Image->open($file));

		// Verifica se foi criado o resource
		$this->assertTrue($this->Image->isLoaded());

		// Verifica se o mimetype é gif
		$mineType = $this->Image->mimeType;
        // $this->assertEqual('gif',$mineType);
        $this->assertTrue('gif' === $mineType);

        // Fecha a imagem
        $this->Image->close();

		// Abrir um arquivo em formato nao suportado
		$file = $this->imgPath.'/exemplo.tif';
		$this->assertFalse($this->Image->open($file));
    }

    /**
     * Tests RW_Image->close()
     */
    public function testClose ()
    {
        $file = $this->imgPath.'/exemplo.jpg';
    	$this->Image->open($file);
    	// Fecha o arquivo
    	$this->assertTrue($this->Image->close());

    }

    /**
     * Tests RW_Image->isLoaded()
     */
    public function testIsLoaded ()
    {
        // Cria o arquivo temporário
        copy($this->imgPath.'/exemplo.jpg', $this->imgPath.'/saves/temp.jpg');

        // Deifne o arquivo a ser usado para os testes
        $file = $this->imgPath.'/saves/temp.jpg';
    	$this->Image->open($file);

    	// Verifica o resource
        $this->assertTrue($this->Image->isLoaded());

        // Fecha a imagem
        $this->Image->close();

        // Verifica a imagem
        // $this->assertNull($this->Image->isLoaded());

        // Abre a imagem novamente
        $file = $this->imgPath.'/saves/temp.jpg';
        $this->Image->open($file);

        // Salva a imagem sem a opção de fechar
        $this->Image->save();

        // Verifica se is loades
        $this->assertTrue($this->Image->isLoaded());

        // Salva a imagem com opção de fechar
        $this->Image->save($file,true);

        // veriicca o isLoaded
        // $this->assertFalse($this->Image->isLoaded());

        // apago o arquivo temporário
        unlink($file);
    }
    /**
     * Tests RW_Image->save()
     */
    public function testSave ()
    {
        $file = $this->imgPath.'/exemplo.jpg';
    	$this->Image->open($file);
        $this->assertTrue($this->Image->save(true));

    }

    /**
     * Tests RW_Image->sendScreen()
     */
    public function testSendScreen ()
    {
        // TODO Auto-generated ImageTest->testSendScreen()
        $this->markTestIncomplete("sendScreen test not implemented");
		// $file = dirname(__FILE__).'/img/songbird.png';
		// $this->Image->open($file);
        // $this->assertTrue($this->Image->sendScreen());

    }

    /**
     * Tests RW_Image->resize()
     */
    public function testResize ()
    {
    	// Cria o arquivo temporário
        copy($this->imgPath.'/exemplo.jpg', $this->imgPath.'/saves/temp.jpg');

        // Abrir JPG
        $file = $this->imgPath.'/saves/temp.jpg';
        $this->Image->open($file);

        // Reduz o tamanho do JPG com crop
        $this->assertTrue($this->Image->resize('500','150',true,true));

        // Salva Mudanças
		$this->assertTrue($this->Image->save());

		// Pega tamanho da imagens após mudança
		list($width, $height, $type, $attr)= getimagesize($file);

		// Compra os tamanhos passados e reais da imagem
		$this->assertEquals('500', $width);
		$this->assertEquals('150', $height);

		// Fecha o arquivo
		$this->Image->close();

		// Abrir JPG
        $this->Image->open($file);

        // Aumenta a imagem JPG com Crop e forçado
		$this->assertTrue($this->Image->resize('1000','2',true,true));
		$this->assertTrue($this->Image->save());

		// Pega tamanho da imagem após mudança
		list($width, $height, $type, $attr)= getimagesize($file);

		// Compara os tamanhos pedidos e reais
		$this->assertEquals('1000', $width);
		$this->assertEquals('2', $height);

		// Fecha a imagem
		$this->Image->close();

		// Abrir JPG
        $this->Image->open($file);

        // Reduz a imagem JPG com Crop e forçado
		$this->assertTrue($this->Image->resize('50','1',true,true));
		$this->assertTrue($this->Image->save());

		// Retornar os atributos da imagem
		list($width, $height, $type, $attr)= getimagesize($file);

		$this->assertEquals('50', $width);
		$this->assertEquals('1', $height);
		unlink($file);

		// Sem Crop e reduzindo forçado
		copy($this->imgPath.'/exemplo_600x800.jpg', $this->imgPath.'/saves/temp.jpg');

		// Abrir JPG
        $this->Image->open($file);

        // Reduzir imagem sem crop e forçado
		$this->assertTrue($this->Image->resize('113','150',false,true));
		$this->assertTrue($this->Image->save());

		// Pega tamanho da imagem após mudança
		list($width, $height, $type, $attr)= getimagesize($file);

		// Compra os tamanhos pedidos e reais
		$this->assertEquals('113', $width);
		$this->assertEquals('150', $height);

		// Fecha a imagem
		$this->Image->close();

		// Abrir JPG
        $this->Image->open($file);

        // Reduz a imagem JPG com Crop e forçado
		$this->assertTrue($this->Image->resize('10','149',false,true));
		$this->assertTrue($this->Image->save());

		// Retornar os atributos da imagem
		list($width, $height, $type, $attr)= getimagesize($file);

		$this->assertEquals('10', $width);
		$this->assertEquals('13', $height);

		unlink($file);

		/*COM ARQUIVO PNG*/

    	// Cria o arquivo temporário
        copy($this->imgPath.'/exemplo.png', $this->imgPath.'/saves/temp.png');

        // Abrindo arquivo
        $file = $this->imgPath.'/saves/temp.png';
        $this->Image->open($file);

        // aumentando o PNG COM CROP
		$this->assertTrue($this->Image->resize('1000','500', true,true));
		$this->assertTrue($this->Image->save());

		// conferindo os valores salvos
		list($width, $height, $type, $attr)= getimagesize($file);
		$this->assertEquals('1000', $width);
		$this->assertEquals('500', $height);

        // Abirndo o PNG
        $this->Image->open($file);

        // Reduzir PNG
		$this->assertTrue($this->Image->resize('200','100'));
		$this->assertTrue($this->Image->save());

		// conferindo os valores
		list($width, $height, $type, $attr)= getimagesize($file);
		$this->assertEquals('200', $width);
		$this->assertEquals('100', $height);

		// fechando o arquivo
		$this->Image->close();

		// deletando o arquivo
		unlink($file);

		// Cria o arquivo temporário
        copy($this->imgPath.'/exemplo.jpg', $this->imgPath.'/saves/temp.jpg');
        $file = $this->imgPath.'/saves/temp.jpg';

        // abrindo o arquivo
        $this->Image->open($file);

        // rezudindo o arquivo SEM CROP
		$this->assertTrue($this->Image->resize('1000','10',false,true));
		$this->assertTrue($this->Image->save());

		// fechando o arquivo
		$this->Image->close();

		// deletando o arquivo
		unlink($file);
    }

    /**
     * Tests RW_Image->removeMetadata()
     */
    public function testRemoveMetadata ()
    {
		 // Cria o arquivo temporário
         copy($this->imgPath.'/exemplo_600x800.jpg', $this->imgPath.'/saves/temp.jpg');
         $file = $this->imgPath.'/saves/temp.jpg';

         // Salva os metadados antes de alterar
         $metadados = exif_read_data($file);

         // Abre o arquivo
         $this->Image->open($file);

         // remove os metadados
         $this->assertTrue($this->Image->removeMetadata());

         // salva as alterações
         $this->Image->save(null,true);

         // Metadado atuais
         $atual = exif_read_data($file);

         // Compara os metadados
         $this->assertNotEquals($metadados, $atual);
         unlink($file);
    }
}

