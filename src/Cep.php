<?php
/**
 * Valida e formata o Cep
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Cep
{
    /**
     * Formata o CEP no padrão 00000-000
     * Não é feita nenhuma validação
     *
     * @param string $cep CEP com ou sem formatação
     *
     * @return string
     */
    public static function format($cep)
    {
        // Reduz ao CEP desformatado
        $cep = self::unformat($cep);

        // Verifica se há um CEP
        if (! empty($cep)) {
            $cep = substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
        }

        // Retorna o CEP formatado
        return $cep;
    }

    /**
     * Remove a formatação do CEP, reduzindo a apenas numeros
     *
     * @param string $cep
     * @return string
     */
    public static function unformat($cep)
    {
        // Remove tudo que não for numeros
        $cep = preg_replace('/[^0-9]/', '', $cep);

        // Verifica se sobrou numero para o CEP
        //@todo verificar o tamanho minimo de um CEP
        if (! empty($cep)) {
            return str_pad($cep, 8, '0', STR_PAD_LEFT);
        }

        // Se não achou um CEP possível retorna vazio
        return '';
    }
}
