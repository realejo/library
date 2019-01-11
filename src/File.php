<?php
/**
 * Classe para manipular strings
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */

namespace Realejo;

class File
{
    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Lê um arquivo e retorna o contéudo em pedaços (chunk)
     * Deve ser usado quando tiver um download com acesso restrito e/ou
     * o arquivo for muito grande ou puder ser lido em pedaços. Ex: FLV, MPG
     *
     * @param string $filename Nome do arquivo a ser enviado
     * @param bool $retbytes OPCIONAL indica se deve retornar o numero de bytes ou o status da conexão
     * @param int $chunk OPCIONAL Tamanho em byte do chunk. Padrão: 1024*1024 = 1048576
     * @return bool|int
     */
    public static function readfileChunked($filename, $retbytes = true, $chunk = 1048576)
    {
        // Abre o arquivo no formato de laitura de bytes
        $handle = fopen($filename, 'rb');
        if ($handle === false) {
            return false;
        }

        $totalBytes = 0;
        while (!feof($handle)) {
            $buffer = fread($handle, $chunk);
            echo $buffer;
            ob_flush();
            flush();
            if ($retbytes) {
                $totalBytes += strlen($buffer);
            }
        }
        $status = fclose($handle);
        if ($retbytes && $status) {
            // Retorna o numero de bytes enviados.
            //  Os bytes serão retornados como a função readfile() faz
            return $totalBytes;
        }
        return $status;
    }
}
