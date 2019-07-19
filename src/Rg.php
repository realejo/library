<?php
/**
 * Valida e formata o RG (Registro Geral)
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */

namespace Realejo;

class Rg
{
    /**
     * Verifica se o RG é valido
     *
     * @param string $rg RG com ou sem formatação
     * @param string $uf
     * @return boolean
     */
    public static function isValid($rg, $uf = 'SP')
    {
        $rg = self::unformat($rg);

        if (strlen($rg) !== 9 && strlen($rg) !== 10) {
            return false;
        }

        // Até o momento so o estado de SP tem validação de RG
        if ($uf === 'SP') {
            $calc = 0;
            $key = 0;
            for ($t = 9; $t >= 2; $t--) {
                $calc += $rg[$key] * $t;
                $key++;
            }

            // Verifica se o resto é igual ao digito verificador
            if (($calc % 11) !== substr($rg, -1)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Formata o RG no padrão 00.000.000-0 || 000.000.000-0
     * Não é feita nenhuma validação
     *
     * @param string $rg RG com ou sem formatação
     *
     * @return string
     */
    public static function format($rg)
    {
        // Reduz ao RG desformatado
        $rg = self::unformat($rg);

        // Verifica se há um RG
        if (!empty($rg) && strlen($rg) === 9) {
            $rg = substr($rg, 0, 2) . '.' . substr($rg, 2, 3) . '.' . substr($rg, 5, 3) . '-' . $rg[8];
        } elseif (!empty($rg) && strlen($rg) === 10) {
            $rg = substr($rg, 0, 3) . '.' . substr($rg, 3, 3) . '.' . substr($rg, 6, 3) . '-' . $rg[9];
        }

        // Retorna o RG formatado
        return $rg;
    }

    /**
     * Remove a formatação do RG, reduzindo a apenas numeros
     *
     * @param string $rg
     * @return string
     */
    public static function unformat($rg)
    {
        // Remove tudo que não for numeros
        $rg = preg_replace('/\D/', '', $rg);

        // Verifica se sobrou numero para o RG
        //@todo verificar o tamanho minimo de um RG
        if (!empty($rg)) {
            return str_pad($rg, 9, '0', STR_PAD_LEFT);
        }

        // Se não achou um RG possível retorna vazio
        return '';
    }
}
