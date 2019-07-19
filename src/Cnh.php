<?php
/**
 * Valida e formata o CNH (Carteira Nacional de Habilitação)
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */

namespace Realejo;

class Cnh
{
    /**
     * Verifica se o CNH é valido
     *
     * @param string $cnh CNH com ou sem formatação
     * @return boolean
     */
    public static function isValid($cnh)
    {
        if ((strlen($input = self::unformat($cnh)) === 11) && (str_repeat($input[1], 11) != $input)
        ) {
            $dsc = 0;
            for ($i = 0, $j = 9, $v = 0; $i < 9; ++$i, --$j) {
                $v += (int)$input[$i] * $j;
            }
            if (($vl1 = $v % 11) >= 10) {
                $vl1 = 0;
                $dsc = 2;
            }
            for ($i = 0, $j = 1, $v = 0; $i < 9; ++$i, ++$j) {
                $v += (int)$input[$i] * $j;
            }
            $vl2 = ($x = ($v % 11)) >= 10 ? 0 : $x - $dsc;
            if (sprintf('%d%d', $vl1, $vl2) === substr($input, -2)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Formata o CNH no padrão 000.000.000-00
     * Não é feita nenhuma validação
     *
     * @param string $cnh CNH com ou sem formatação
     *
     * @return string
     */
    public static function format($cnh)
    {
        // Reduz ao CNH desformatado
        $cnh = self::unformat($cnh);

        // Verifica se há um CNH
        if (!empty($cnh)) {
            $cnh = substr($cnh, 0, 3) . '.' . substr($cnh, 3, 3) . '.' . substr($cnh, 6, 3) . '-' . substr($cnh, 9, 2);
        }

        // Retorna o CNH formatado
        return $cnh;
    }

    /**
     * Remove a formatação do CNH, reduzindo a apenas numeros
     *
     * @param string $cnh
     * @return string
     */
    public static function unformat($cnh)
    {
        // Remove tudo que não for numeros
        $cnh = preg_replace('/\D/', '', $cnh);

        // Verifica se sobrou numero para o CNH
        //@todo verificar o tamamho minimo de um CNH
        if (!empty($cnh)) {
            return str_pad($cnh, 11, '0', STR_PAD_LEFT);
        }

        // Se não achou um CNH possível retorna vazio
        return '';
    }
}
