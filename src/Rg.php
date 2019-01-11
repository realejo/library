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
     * Formata o RG no padrão 00.000.000-0
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
        if (!empty($rg)) {
            $rg = substr($rg, 0, 2) . '.' . substr($rg, 2, 3) . '.' . substr($rg, 5, 3) . '-' . substr($rg, 8, 1);
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
        $rg = preg_replace('/[^0-9]/', '', $rg);

        // Verifica se sobrou numero para o RG
        //@todo verificar o tamamho minimo de um RG
        if (!empty($rg)) {
            return str_pad($rg, 9, '0', STR_PAD_LEFT);
        }

        // Se não achou um RG possível retorna vazio
        return '';
    }
}
