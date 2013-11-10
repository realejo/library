<?php
/**
 * Funções para busca de DNS
 *
 * @author     Realejo
 * @version    $Id: Base.php 25 2012-05-09 23:40:14Z rodrigo $
 * @copyright  Copyright (c) 2011-2012 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Dns
{
    /**
     * Substituto do gethostbyname() para procurar pelo IPv4 de um host sem usar o cache do PHP
     *
     * @param string  $host    IP ou endereço a ser pesquisado
     * @param int     $timeout OPCIONAL. Tempo máximo de procura
     *
     * @return string
     */
    static function getAddrByHost($host, $timeout = 3)
    {
        // Define a busca pelo prompt
        $query = `nslookup -timeout=$timeout -retry=1 $host`;

        // Executa a busca
        if (preg_match('/\nAddress: (.*)\n/', $query, $matches)) {
            return trim($matches[1]);
        }

        // Retorna o IP encontrado
        return $host;
    }
}
