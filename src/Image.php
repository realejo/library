<?php
/**
 * Classe com funções comuns para tratamenteo de imagens
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */

namespace Realejo;

class Image
{
    /**
     * Imagem carregada
     * @var binary image
     */
    protected $image = null;

    /**
     * Mime types válidos
     * @var array
     */
    protected $fileTypes = [
        'image/gif',
        'image/jpeg',
        'image/png'
    ];

    /**
     * Compressão padrão das imagens
     * @var array
     */
    protected $imageQuality = [
        'png' => 9, // 0..9
        'jpeg' => 100,
        'gif' => 100
    ];

    /**
     * Path original da imagem
     *
     * @var string
     */
    private $path;

    /**
     * Tipo imagem
     *
     * @var string
     */
    protected $mimeType;

    /**
     * Carrega aimagem ao criar a classe
     *
     * @param string $image Endereço da imagem
     */
    public function __construct($image = null)
    {
        // Verifica se há uma imagem para carregar
        if (!is_null($image)) {
            $this->open($image);
        }
    }

    /**
     * Verifica se é uma imagem válida abrindo com função correta
     *
     * @param $file
     * @return bool
     * @throws \Exception
     * @internal param string $arquivo
     */
    public function open($file)
    {
        // Verifica se hpá imagem carregada
        if ($this->isLoaded()) {
            $this->close();
        }

        // Verifica se o arquivo existe
        if (!file_exists($file)) {
            throw new \Exception("Arquivo $file não existe");
        }

        /**
         * Tenta identificar o formato e abrir a imagem
         */
        switch (exif_imagetype($file)) {
            case IMAGETYPE_JPEG:
                $im = imagecreatefromjpeg($file);
                if ($im !== false) {
                    $this->mimeType = 'jpeg';
                    $this->image = $im;
                    $this->path = $file;
                    return true;
                }
                break;

            case IMAGETYPE_GIF:
                $im = imagecreatefromgif($file);
                if ($im !== false) {
                    $this->mimeType = 'gif';
                    $this->image = $im;
                    $this->path = $file;
                    return true;
                }
                break;

            case IMAGETYPE_PNG:
                $im = imagecreatefrompng($file);
                if ($im !== false) {
                    $this->mimeType = 'png';
                    $this->image = $im;
                    $this->path = $file;
                    return true;
                }
                break;
        }

        // Tipo não identificado ou não valido
        return false;
    }

    /**
     * Retira a imagem da memória
     * @return boolean
     */
    public function close()
    {
        // Verifica se a imagem está definida
        if (isset($this->image)) {
            if (is_resource($this->image)) {
                imagedestroy($this->image);
            }
            $this->image = null;

            return true;
        }

        return false;
    }

    /**
     * Verifica se tem alguma imagem carregada
     * @return boolean
     */
    public function isLoaded()
    {
        return !is_null($this->image);
    }

    /**
     * Salva a imagem que está carregada na memória
     *
     * @param string $file Endereço do arquivo para salvar a imagem
     * @param boolean $close Fecha o arquivo ou mantem na memória
     * @return bool
     * @throws \Exception
     */
    public function save($file = null, $close = false)
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new \Exception('Imagem não carregada em Realejo\Image::save();');
        }

        if ($file === true) {
            $file = null;
            $close = true;
        }

        if (is_null($file)) {
            $file = $this->path;
        }

        // Salva a transparencia (alpha channel) dos PNGs
        if ($this->getMimeType() == 'png') {
            imagesavealpha($this->image, true);
        }

        // Define a função de acordo com o file type
        $imageFunction = "image" . $this->getMimeType();

        // Salva a imagem
        $ok = $imageFunction($this->image, $file, $this->imageQuality[$this->getMimeType()]);

        // Verifica se deve fechar
        if ($close && $ok) {
            $this->close();
        }

        return $ok;
    }

    /**
     * Salva a imagem que está carregada na memória
     *
     * @param boolean $close fecha o arquivo ou mantem na memoria
     * @return bool
     * @throws \Exception
     * @internal param string $file
     * @codeCoverageIgnore
     */
    public function sendScreen($close = true)
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new \Exception('Imagem não carregada em Realejo\Image::sendScreen();');
        }

        // @codeCoverageIgnoreStart
        // Define o header de acordo com o file type
        header('Content-Type: image/' . $this->getMimeType());
        // @codeCoverageIgnoreEnd

        // Salva a transparencia (alpha channel) dos PNGs
        if ($this->getMimeType() === 'png') {
            imagesavealpha($this->image, true);
        }

        // Define a função de acordo com o file type
        $imageFunction = "image" . $this->getMimeType();

        // @codeCoverageIgnoreStart
        // Envia para o browser
        $imageFunction($this->image);
        // @codeCoverageIgnoreEnd

        // fecha o arquivo
        if ($close) {
            $this->close();
        }

        return true;
    }

    /**
     * Redimenciona a imagem. Retorna se a imagem foi redimensionada
     *
     * @param int $w largura da imagem
     * @param int $h altura da imagem
     * @param boolean $crop idica se a imagem deve se cortada para o tamanho
     * @param boolean $force aumenta a imagem caso ela seja menor
     * @return bool
     * @throws \Exception
     */
    public function resize($w, $h, $crop = false, $force = false)
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new \Exception('Imagem não carregada em Realejo\Image::resize();');
        }

        // Recupera os tamanhos da imagem
        $newwidth = $width = imagesx($this->image);
        $newheight = $height = imagesy($this->image);

        // Verifica se é para fazer o crop
        if ($crop) {
            // Redimenciona a imagem se necessário
            if (($width > $w) || ($height > $h) || $force) {
                // Calcula o novo tamanho
                if (($width / $w) > ($height / $h)) {
                    $newheight = $h;
                    $newwidth = ($width * $h) / $height;
                } else {
                    $newwidth = $w;
                    $newheight = ($height * $w) / $width;
                }

                // Cria a imagem temporária
                $tmp = imagecreatetruecolor($newwidth, $newheight);

                // Verifica se é um PNG para manter a transparencia
                if ($this->getMimeType() == 'png') {
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);
                    imagealphablending($this->image, true);
                }

                // Redimenciona
                imagecopyresampled($tmp, $this->image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                // Destroi a imagem original
                imagedestroy($this->image);

                // Passa a usar a imagem temporaria
                $this->image = $tmp;
            }

            /**
             * FAZ O CROP
             */

            // Cria a imagem temporária
            $tmp = imagecreatetruecolor($w, $h);

            // Verifica se é um PNG para manter a transparencia
            if ($this->getMimeType() === 'png') {
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);
                imagealphablending($this->image, true);
            }

            // Define o tamanho
            $x = ($newwidth > $w) ? $newwidth / 2 - $w / 2 : 0;
            $y = ($newheight > $h) ? $newheight / 2 - $h / 2 : 0;

            // Faz o crop
            imagecopyresampled($tmp, $this->image, 0, 0, $x, $y, $w, $h, $w, $h);

            // Destroi a imagem original
            imagedestroy($this->image);

            // Passa a usar a imagem temporaria
            $this->image = $tmp;

            // Finaliza com sucesso
            return true;
        }

        // Define os novos tamanhos
        if (($width > $w) || ($height > $h) || $force) {
            if (($width / $w) > ($height / $h)) {
                $newwidth = $w;
                $newheight = round(($height * $w) / $width);
            } else {
                $newheight = $h;
                $newwidth = round(($width * $h) / $height);
            }
        }

        // Verifica se o tamamnho mudou
        if (($newheight != $height) || ($newwidth != $width)) {
            // Cria a imagem temporária
            $tmp = imagecreatetruecolor($newwidth, $newheight);

            // Verifica se é um PNG para manter a transparencia
            if ($this->getMimeType() === 'png') {
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);
                imagealphablending($this->image, true);
            }

            // Faz o redimencionamento
            imagecopyresampled($tmp, $this->image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            // Destroi a imagem original
            imagedestroy($this->image);

            // Passa a usar a imagem temporaria
            $this->image = $tmp;

            // Finaliza com sucesso
            return true;
        }

        return false;
    }

    /**
     * Remove as informações extra das imagens (EXIF)
     * Para isso ele redimenciona para o mesmo tamanho pois o GD não copia o EXIF
     * @return bool
     * @throws \Exception
     */
    public function removeMetadata()
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new \Exception('Imagem não carregada em Realejo\Image::removeMetadata();');
        }

        // Redimenciona a imagem para o mesmo tamanho dela. Isto irá criar uma nova imagem sem os metadados
        $width = imagesx($this->image);
        $height = imagesy($this->image);
        $this->resize($width, $height, false, true);
        return true;
    }

    /**
     * Altera a qualidade padrão das imagens (100%).
     *
     * @param int $quality Qualidade da imagem de 0 a 100
     * @param string $mimeType OPCIONAL Formato a ser definido a nova qualidade (png, jpg ou gif)
     * @return Image
     * @throws \Exception
     */
    public function setImageQuality($quality, $mimeType = null)
    {
        // Passa o formato para minusculo se existir
        if (!is_null($mimeType)) {
            $mimeType = strtolower($mimeType);
        }

        // Verifica se foi informado um formato específico
        if (!is_null($mimeType)) {
            // Verifica se o formato é valido
            if (array_key_exists($mimeType, $this->imageQuality)) {
                if ($mimeType === 'png') {
                    $quality = ($quality / 10) - 1;
                }
                $this->imageQuality[$mimeType] = $quality;
            } else {
                throw new \Exception("Formato de imagem $mimeType inválido em Realejo\Image::setImageQuality()");
            }

            // Altera todos os formatos
        } else {
            $this->imageQuality['jpg'] = $quality;
            $this->imageQuality['gif'] = $quality;
            $this->imageQuality['png'] = ($quality / 10) - 1;
        }

        // Mantem a cadeia
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        // Passa o formato para minusculo se existir
        if (!is_null($mimeType)) {
            $format = strtolower($mimeType);
        }

        $this->mimeType = $mimeType;
    }
}
