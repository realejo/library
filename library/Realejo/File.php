<?php
/**
 * Classe para manipular strings
 *
 * @author     Realejo
 * @version    $Id: UF.php 34 2012-06-19 14:21:55Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class File
{
    /**
     * Lê um arquivo e retorna o contéudo em pedaços (chunk)
     * Deve ser usado quando tiver um download com acesso restrito e/ou
     * o arquivo for muito grande ou puder ser lido em pedaços. Ex: FLV, MPG
     *
     * @param string  $filename  Nome do arquivo a ser enviado
     * @param bool    $retbytes  OPCIONAL indica se deve retornar o numero de bytes ou o status da conexão
     * @param int     $chunk     OPCIONAL Tamanho em byte do chunk. Padrão: 1024*1024 = 1048576
     */
    static public function readfileChunked($filename, $retbytes = true, $chunk = 1048576)
    {
        // Abre o arquivo no formato de laitura de bytes
        $handle = fopen($filename, 'rb');
        if ($handle === false) return false;

        $totalBytes= 0;
        while ( !feof($handle) ) {
            $buffer = fread($handle, $chunk);
            echo $buffer;
            ob_flush();
            flush();
            if ($retbytes) $totalBytes += strlen($buffer);
        }
        $status = fclose($handle);
        if ($retbytes && $status) {
            return $totalBytes; // Retorna o numero de bytes enviados. Os bytes serão retornados como a função readfile() faz
        }
        return $status;
    }
}