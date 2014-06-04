<?php
/**
 * Classe para manipular CSV
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Csv
{
    /**
     * Transforma um array em um CSV.
     * As chaves do primeiro item do array serão usadas como titulo das colunas
     * do CSV a ser criado
     *
     * @param array $array   Array com os dados a serem transformados em CSV
     * @param array $exclude Lista de campos que não devem ser incluídos no CSV
     * @param array $labels  Titulo alterantido para as chaves definidas no primeiro item
     * @return string
     */
    public static function getCSV($array, $exclude = array(), $labels = array())
    {
        // Verifica se há dados para gerar o CSV
        if (!is_array($array) || empty($array)) return '';

        // Recuperar o primeiro registro para ter os nomes dos campos
        $keys = array_keys($array);
        $keys = array_keys($array[$keys[0]]);

        // Verifica os campos a serem excluídos
        if (is_null($exclude)) {
            $exclude = array();
        } elseif (!is_array($exclude)) {
            $exclude = array($exclude);
        }

        // Arruma o array de exclusão
        $temp = array();
        foreach ($exclude as $e) {
            $temp[$e] = $e;
        }

        // Remove as chaves não usadas
        $keys = array_diff($keys,$exclude);

        $exclude = $temp;

        // Coloca as chaves no CSV
        $temp = $keys;
        foreach ($temp as $i=>$k) {
            if (array_key_exists($k, $labels)) $temp[$i] = $labels[$k];
        }
        $csv = array(mb_strtoupper(implode(';',$temp), 'UTF-8'));

        // Constroi o CSV
        foreach($array as $row) {
            // Remove as chaves não usadas
            $row = array_diff_key($row, $exclude);

            // Coloca no CSV
            $csv[] =  '"'. implode('";"',$row) .'"';
        }

        $csv = implode("\n", $csv);

        return $csv;
    }
}
