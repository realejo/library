<?php
/**
 * Valida e formata o CNPJ
 *
 * @author     Realejo
 * @version    $Id: CNPJ.php 46 2012-11-26 16:10:22Z rodrigo $
 * @copyright  Copyright (c) 2013 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Cnpj
{
    /**
     * Verifica se o CNPJ é valido
     *
     * @param string $cnpj CNPJ com ou sem formatação
     * @return boolean
     */
    static function valid($cnpj)
    {
        $cnpj = self::unformat($cnpj);

        // Verifica se não é inválido
        if ($cnpj == '00000000000000') return false;

        $dig_1 = 0;
        $dig_2 = 0;
        $controle_1 = 5;
        $controle_2 = 6;
        $resto = 0;

        //coloca no formato padrao
        for ( $i=0 ; $i < 12 ; $i++) {
            $dig_1 = $dig_1 + (double)(substr($cnpj, $i, 1) * $controle_1);
            $controle_1 = $controle_1 - 1;
            if ($i == 3) {
                $controle_1 = 9;
            }
        }

        $resto = $dig_1 % 11;
        $dig_1 = 11 - $resto;
        if (($resto == 0) || ($resto == 1)){
            $dig_1 = 0;
        }
        for ( $i=0 ; $i < 12 ; $i++) {
            $dig_2 = $dig_2 + (int) (substr($cnpj, $i, 1) * $controle_2);
            $controle_2 = $controle_2 - 1;
            if ($i == 4) {
                $controle_2 = 9;
            }
        }
        $dig_2 = $dig_2 + (2 * $dig_1);
        $resto = $dig_2 %11;
        $dig_2 = 11 - $resto;
        if (($resto == 0) || ($resto == 1)){
            $dig_2 = 0;
        }
        $dig_ver = ($dig_1 * 10) + $dig_2;
        if ($dig_ver != (double)(substr($cnpj, strlen($cnpj)-2,2))) {
            return false;
        }
        return true;
    }

    /**
     * Formata o CNPJ no padrão 00.000.000/0000-00
     *
     * @param string $cnpj CNPJ com ou sem formatação
     * @return string
     */
    static function format($cnpj)
    {
        if ( !is_null($cnpj) && $cnpj != '') {
            $cnpj = self::unformat($cnpj);
            $cnpj = substr($cnpj,0,2) . '.' . substr($cnpj,2,3) . '.' . substr($cnpj,5,3) . '/' . substr($cnpj,8,4) . '-' . substr($cnpj,12,2);
        }
        return $cnpj;

    }

    /**
     * Remove a formatação do CNPJ, reduzindo a apenas numeros
     *
     * @param string $cpf
     * @return string
     */
    static function unformat($cnpj)
    {
        if ( !empty($cnpj) ) {
            $cnpj = str_pad(preg_replace('/[^0-9]/', '', $cnpj), 14, '0', STR_PAD_LEFT);
        } else $cnpj = '';
        return $cnpj;
    }
}
