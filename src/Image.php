<?php
/**
 * Classe com funções comuns para tratamenteo de imagens
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */

namespace Realejo;

use InvalidArgumentException;
use RuntimeException;

class Image
{
    public const MIME_TYPE_JPEG = 'jpeg';
    public const MIME_TYPE_PNG = 'png';
    public const MIME_TYPE_GIF = 'gif';

    protected $interlaced = false;

    /**
     * @var resource image
     */
    protected $image;

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
        self::MIME_TYPE_PNG => 9, // 0..9
        self::MIME_TYPE_JPEG => 100,
        self::MIME_TYPE_GIF => 100
    ];

    /**
     * @var string
     */
    private $path;

    /**
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
        if ($image !== null) {
            $this->open($image);
        }
    }

    /**
     * Verifica se é uma imagem válida abrindo com função correta
     *
     * @param $file
     * @return bool
     */
    public function open(string $file)
    {
        // Verifica se hpá imagem carregada
        if ($this->isLoaded()) {
            $this->close();
        }

        // Verifica se o arquivo existe
        if (!file_exists($file)) {
            throw new InvalidArgumentException("Arquivo $file não existe");
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
    public function close(): bool
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
        return $this->image !== null;
    }

    /**
     * Salva a imagem que está carregada na memória
     *
     * @param string $file Endereço do arquivo para salvar a imagem
     * @param boolean $close Fecha o arquivo ou mantem na memória
     * @return bool
     */
    public function save($file = null, $close = false)
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new RuntimeException('Imagem não carregada em Realejo\Image::save();');
        }

        if ($file === true) {
            $file = null;
            $close = true;
        }

        if ($file === null) {
            $file = $this->path;
        }

        // Salva a transparencia (alpha channel) dos PNGs
        if ($this->getMimeType() === self::MIME_TYPE_PNG) {
            imagesavealpha($this->image, true);
        }

        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new RuntimeException('Image not loaded.');
        }

        // Salva a transparencia (alpha channel) dos PNGs
        if ($this->getMimeType() === self::MIME_TYPE_JPEG) {
            imageinterlace($this->image, $this->interlaced);
        }

        // Define a função de acordo com o file type
        $imageFunction = 'image' . $this->getMimeType();

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
     * @internal param string $file
     * @codeCoverageIgnore
     */
    public function sendScreen(bool $close = true): bool
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new RuntimeException('Image not loaded.');
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
     */
    public function resize(int $w, int $h, bool $crop = false, bool $force = false): bool
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new RuntimeException('Imagem not loaded');
        }

        // Recupera os tamanhos da imagem
        $newWidth = $width = imagesx($this->image);
        $newHeight = $height = imagesy($this->image);

        // Verifica se é para fazer o crop
        if ($crop) {
            // Redimenciona a imagem se necessário
            if (($width > $w) || ($height > $h) || $force) {
                // Calcula o novo tamanho
                if (($width / $w) > ($height / $h)) {
                    $newHeight = $h;
                    $newWidth = ($width * $h) / $height;
                } else {
                    $newWidth = $w;
                    $newHeight = ($height * $w) / $width;
                }

                // Cria a imagem temporária
                $tmp = imagecreatetruecolor($newWidth, $newHeight);

                // Verifica se é um PNG para manter a transparencia
                if ($this->getMimeType() === self::MIME_TYPE_PNG) {
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);
                    imagealphablending($this->image, true);
                }

                // Redimenciona
                imagecopyresampled($tmp, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

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
            $x = ($newWidth > $w) ? $newWidth / 2 - $w / 2 : 0;
            $y = ($newHeight > $h) ? $newHeight / 2 - $h / 2 : 0;

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
                $newWidth = $w;
                $newHeight = round(($height * $w) / $width);
            } else {
                $newHeight = $h;
                $newWidth = round(($width * $h) / $height);
            }
        }

        // Verifica se o tamanho mudou
        if (($newHeight !== $height) || ($newWidth !== $width)) {
            // Cria a imagem temporária
            $tmp = imagecreatetruecolor($newWidth, $newHeight);

            // Verifica se é um PNG para manter a transparencia
            if ($this->getMimeType() === 'png') {
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);
                imagealphablending($this->image, true);
            }

            // Faz o redimencionamento
            imagecopyresampled($tmp, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

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
     */
    public function removeMetadata(): bool
    {
        // Verifica se tem imagem carregada
        if (!$this->isLoaded()) {
            throw new RuntimeException('Image not loaded.');
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
     */
    public function setImageQuality(int $quality, $mimeType = null): Image
    {
        // Passa o formato para minusculo se existir
        if ($mimeType !== null) {
            $mimeType = strtolower($mimeType);
        }

        // Verifica se foi informado um formato específico
        if ($mimeType !== null) {
            // Verifica se o formato é valido
            if (array_key_exists($mimeType, $this->imageQuality)) {
                if ($mimeType === self::MIME_TYPE_PNG) {
                    $quality = (int)($quality / 10) - 1;
                }
                $this->imageQuality[$mimeType] = $quality;
            } else {
                throw new InvalidArgumentException("Invalid $mimeType format");
            }

            // Altera todos os formatos
        } else {
            $this->imageQuality['jpg'] = $quality;
            $this->imageQuality['gif'] = $quality;
            $this->imageQuality['png'] = (int)($quality / 10) - 1;
        }

        // Mantem a cadeia
        return $this;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function setMimeType($mimeType): void
    {
        // Passa o formato para minusculo se existir
        if ($mimeType !== null) {
            $mimeType = strtolower($mimeType);
        }

        $this->mimeType = $mimeType;
    }

    public function setInterlace(bool $interlaced): void
    {
        $this->interlaced = $interlaced;
    }

    public function getInterlace(): bool
    {
        return $this->interlaced;
    }
}
