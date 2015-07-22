<?php

namespace RealejoTest;

/**
 * Image test case.
 */
use Realejo\Image;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $imgPath;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // path para as imagens
        $this->imgPath = realpath(__DIR__ . '/_files');

        // Remove as imagens temporárias
        $this->removeTempImages();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();

        // Remove as imagens temporárias
        $this->removeTempImages();
    }

    /**
     * Tests Image->__construct()
     */
    public function test__construct()
    {
        $oImage = new Image();
        $this->assertInstanceOf('Realejo\Image', $oImage);

        $oImage = new Image($this->imgPath.'/exemplo.jpg');
        $this->assertInstanceOf('Realejo\Image', $oImage);
    }

    /**
     * Tests Image->open() inválido
     *
     * @expectedException  Exception
     */
    public function testConstructNaoExistente()
    {
        // Abre arquivo inexistente
        new Image($this->imgPath.'/naoexiste.jpg');
    }

    /**
     * Tests Image->open() inválido
     *
     * @expectedException  Exception
     */
    public function testOpenNaoExistente()
    {
        // Abre arquivo inexistente
        $oImage = new Image();
        $oImage->open($this->imgPath.'/naoexiste.jpg');
    }

    /**
     * Tests Image->open()
     */
    public function testOpen()
    {
        // Abre JPG
        $oImage = new Image();
        $this->assertTrue($oImage->open($this->imgPath.'/exemplo.jpg'));
        $this->assertInstanceOf('Realejo\Image', $oImage);

        // Verifica se foi criado o resource
        $this->assertTrue($oImage->isLoaded());

        // Verifica se o mimetype é JPEG
        $this->assertStringMatchesFormat('jpeg', $oImage->getMimeType());

        // Fecha a imagem
        $oImage->close();

        // Verifica se foi criado o resource
        $this->assertFalse($oImage->isLoaded());

        // Abre PNG
		$file = $this->imgPath.'/exemplo.png';
		$this->assertTrue($oImage->open($file));

		// Verifica se foi criado o resource
		$this->assertTrue($oImage->isLoaded());

		// Verifica se o mimetype é PNG
        $this->assertStringMatchesFormat('png', $oImage->getMimeType());

        // Fecha a imagem
        $oImage->close();

        // Verifica se foi criado o resource
        $this->assertFalse($oImage->isLoaded());

		// Abre GIF
		$this->assertTrue($oImage->open($this->imgPath.'/exemplo.gif'));

		// Verifica se foi criado o resource
		$this->assertTrue($oImage->isLoaded());

		// Verifica se o mimetype é gif
        $this->assertStringMatchesFormat('gif', $oImage->getMimeType());

        // Fecha a imagem
        $oImage->close();

        // Verifica se foi criado o resource
        $this->assertFalse($oImage->isLoaded());

		// Abre um arquivo em formato nao suportado
		$this->assertFalse($oImage->open($this->imgPath.'/exemplo.tif'));

		// Verifica se foi criado o resource
		$this->assertFalse($oImage->isLoaded());
    }

    /**
     * Tests Image->close()
     */
    public function testClose()
    {
        // Cria o objeto magem
    	$oImage = new Image($this->imgPath.'/exemplo.jpg');

    	// Verifica se o resource foi criado
    	$this->assertTrue($oImage->isLoaded());

    	// Fecha o arquivo
    	$this->assertTrue($oImage->close());

    	// Verifica se o resource foi removido
    	$this->assertFalse($oImage->isLoaded());

    	// Não é possível fechar mais de uma fez o arquivo
    	$this->assertFalse($oImage->close());
    }

    /**
     * Tests Image->isLoaded()
     */
    public function testIsLoaded()
    {
        // Define o arquivo a ser usado para os testes
        $filename = $this->imgPath.'/exemplo.jpg';

        // Cria o objeto da imagem
        $oImage = new Image($filename);

    	// Verifica se a imagem está carregada
        $this->assertTrue($oImage->isLoaded());

        // Destroi o objeto
        unset($oImage);

        // Cria o objeto da imagem
        $oImage = new Image();

        // Verifica se carregou a imagem
        $this->assertFalse($oImage->isLoaded());

        // Carrega a imagem
        $this->assertTrue($oImage->open($filename));

        // Verifica se a imagem está carregada
        $this->assertTrue($oImage->isLoaded());

        // Fecha a imagem
        $oImage->close();

        // Verifica se a imagem não está mais carregada
        $this->assertFalse($oImage->isLoaded());

        // Destroi o objeto
        unset($oImage);


        // Cria o arquivo temporário
        $filenameTemp = $this->imgPath.'/temp/teste.jpg';
        copy($filename, $filenameTemp);

        // Abre a imagem novamente
        $oImage = new Image();
        $oImage->open($filenameTemp);

        // Verifica se a imagem está carregada
        $this->assertTrue($oImage->isLoaded());

        // Salva a imagem sem a opção de fechar
        $oImage->save();

        // Verifica se a imagem continua  carregada
        $this->assertTrue($oImage->isLoaded());

        // Salva a imagem com opção de fechar
        $oImage->save($filenameTemp, true);

        // Verifica se a imagem não está mais carregada
        $this->assertFalse($oImage->isLoaded());

        // apaga o arquivo temporário
        unlink($filenameTemp);
    }

    /**
     * Tests Image->save()
     */
    public function testSave()
    {
        // Cria o arquivo temporário
        $filenameTemp = $this->imgPath.'/temp/teste.jpg';
        copy($this->imgPath.'/exemplo.jpg', $filenameTemp);

        // Abre a imagem
    	$oImage = new Image($filenameTemp);

    	// Salva sem alterações
        $this->assertTrue($oImage->save(true));
    }

    /**
     * Tests Image->sendScreen()
     */
    public function testSendScreen()
    {
        // TODO Auto-generated ImageTest->testSendScreen()
        $this->markTestSkipped("sendScreen test not implemented");
		// $file = dirname(__FILE__).'/img/songbird.png';
		// $oImage->open($file);
        // $this->assertTrue($oImage->sendScreen());
    }

    /**
     * Tests Image->resize()
     */
    public function testResize()
    {
    	// Cria o arquivo temporário
        copy($this->imgPath.'/exemplo.jpg', $this->imgPath.'/temp/temp.jpg');

        // Carrega o JPG
        $filepath = $this->imgPath.'/temp/temp.jpg';
        $oImage = new Image($filepath);

        // Reduz o tamanho do JPG com crop
        $this->assertTrue($oImage->resize('500', '150', true, true));

        // Salva as mudanças
		$this->assertTrue($oImage->save());

		// Pega tamanho da imagens após mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('500', $width);
		$this->assertEquals('150', $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);

		// Abre o JPG
        $oImage = new Image($filepath);

        // Aumenta a imagem JPG com Crop e forçado
		$this->assertTrue($oImage->resize('1000', '2', true, true));

		// Salva as mudanças
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('1000', $width);
		$this->assertEquals('2', $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);

		// Abre o JPG
        $oImage = new Image($filepath);

        // Reduz a imagem JPG com Crop e forçado
		$this->assertTrue($oImage->resize('50', '1', true, true));
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('50', $width);
		$this->assertEquals('1', $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);

		// Sem Crop e reduzindo forçado
		copy($this->imgPath.'/exemplo_800x600.jpg', $this->imgPath.'/temp/temp.jpg');

		// Abre JPG
        $oImage = new Image($filepath);

        // Reduz o  imagem sem crop e forçado
		$this->assertTrue($oImage->resize('113','150',false,true));
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr)= getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('113', $width);
		$this->assertEquals('150', $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);

		// Abre JPG
        $oImage = new Image($filepath);

        // Reduz a imagem JPG com Crop e forçado
		$this->assertTrue($oImage->resize('10', '149', false, true));
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('10', $width);
		$this->assertEquals('13', $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);

		// Cria o arquivo temporário
		copy($this->imgPath.'/exemplo_1024x768.jpg', $this->imgPath.'/temp/temp.jpg');
		$filepath = $this->imgPath.'/temp/temp.jpg';

		// Abre o arquivo
		$oImage = new Image($filepath);

		// Reduz o arquivo SEM CROP
		$this->assertTrue($oImage->resize('800', '600', false, true));
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('800', $width);
		$this->assertEquals('600',   $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);

		/**
		 * ARQUIVO PNG
		 */

    	// Cria o arquivo temporário
        copy($this->imgPath.'/exemplo.png', $this->imgPath.'/temp/temp.png');

        // Abre arquivo
        $filepath = $this->imgPath.'/temp/temp.png';
        $oImage = new Image($filepath);

        // aumentando o PNG COM CROP
		$this->assertTrue($oImage->resize('1000','500', true, true));
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('1000', $width);
		$this->assertEquals('500', $height);

        // Abre o PNG
        $oImage->open($filepath);

        // Reduz o PNG
		$this->assertTrue($oImage->resize('200','100'));
		$this->assertTrue($oImage->save());

		// Recupera o tamanho da imagem após a mudança
		list($width, $height, $type, $attr) = getimagesize($filepath);

		// Compara os tamanhos passados e reais da imagem
		$this->assertEquals('200', $width);
		$this->assertEquals('100', $height);

		// Fecha o arquivo
		$oImage->close();

		// Destroi o objeto
		unset($oImage);
    }

    /**
     * Tests Image->removeMetadata()
     *
     * NOTA: exif_read_data retorma mais do que metadados que queremos remover
     */
    public function testRemoveMetadata()
    {
		 // Cria o arquivo temporário
		 $source = $this->imgPath.'/exemplo_800x600.jpg';
		 $target = $this->imgPath.'/temp/metadateTest.jpg';
         copy($source, $target);

         // Salva os metadados do arquivo original
         $original = exif_read_data($source);

         // Abre o arquivo
         $oImage = new Image($target);

         // Remove os metadados
         $this->assertTrue($oImage->removeMetadata());

         // salva as alterações
         $oImage->save();

         // Metadado atuais
         $atual = exif_read_data($target);

         // Compara os metadados
         $this->assertNotEquals($original, $atual);
    }

    public function removeTempImages()
    {
        $files = scandir($this->imgPath.'/temp');
        foreach ($files as $f) {
            if ($f === '.' || $f === '..' || $f === '.gitignore') continue;
            unlink($this->imgPath."/temp/$f");
        }
    }
}
