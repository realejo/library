<?php
/**
 * Valida e formata o CPF
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Cpf
{
    /**
     * Verifica se o CPF é valido
     *
     * @param string   $cpf CPF com ou sem formatação
     * @return boolean
     */
    static function isValid($cpf)
    {
        $cpf = self::unformat($cpf);

        if (strlen($cpf) != 11 ||
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') return false;

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }

    /**
     * Formata o CPF no padrão 000.000.000-00
     * Não é feita nenhuma validação
     *
     * @param string $cpf CPF com ou sem formatação
     *
     * @return string
     */
    static function format($cpf)
    {
        // Reduz ao CPF desformatado
        $cpf = self::unformat($cpf);

        // Verifica se há um CPF
        if ( !empty($cpf) ) {
            $cpf = substr($cpf,0,3) . '.' . substr($cpf,3,3) . '.' . substr($cpf,6,3) . '-' . substr($cpf,9,2);
        }

        // Retorna o CPF formatado
        return $cpf;
    }

    /**
     * Remove a formatação do CPF, reduzindo a apenas numeros
     *
     * @param string $cpf
     * @return string
     */
    static function unformat($cpf)
    {
        // Remove tudo que não for numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se sobrou numero para o CPF
        //@todo verificar o tamamho minimo de um CPF
        if ( !empty($cpf) ) {
            return str_pad($cpf, 11, '0', STR_PAD_LEFT);
        }

        // Se não achou um CPF possível retorna vazio
        return '';
    }
}
