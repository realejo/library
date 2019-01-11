<?php
/**
 * Valida e formata o CREA (Conselho Regional de Engenharia e Agronomia)
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Crea
{
    /**
     * Formata o CREA no padrão 000000000-0
     * Não é feita nenhuma validação
     *
     * @param string $crea CREA com ou sem formatação
     *
     * @return string
     */
    public static function format($crea)
    {
        // Reduz ao CREA desformatado
        $crea = self::unformat($crea);

    // Verifica se há um RG
        if (!empty($crea)) {
            $crea = substr($crea, 0, 9) . '-' . substr($crea, 9, 1);
        }

        // Retorna o CREA formatado
        return $crea;
    }

    /**
     * Remove a formatação do CREA, reduzindo a apenas numeros
     *
     * @param string $crea
     * @return string
     */
    public static function unformat($crea)
    {
        // Remove tudo que não for numeros
        $crea = preg_replace('/[^0-9]/', '', $crea);

        // Verifica se sobrou numero para o CREA
        //@todo verificar o tamamho minimo de um CREA
        if (!empty($crea)) {
            return str_pad($crea, 10, '0', STR_PAD_LEFT);
        }

        // Se não achou um CREA possível retorna vazio
        return '';
    }
}
