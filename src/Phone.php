<?php
/**
 * Valida e formata o Phone
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Phone
{
    /**
     * Formata o Phone no padrão (00) 0000-0000 ou (00) 00000-0000
     * Não é feita nenhuma validação
     *
     * @param string $phoneNumber Phone com ou sem formatação
     * @param string $cellPhone   Se é um Celular ou não
     *
     * @return string
     */
    public static function format($phoneNumber, $cellPhone = false)
    {
        // Reduz ao Phone desformatado
        $phoneNumber = self::unformat($phoneNumber);

        // Total de digitos só do tipo de telefone
        $totalNumber = ($cellPhone) ? 11 : 10;

        // Total de digitos só do tipo de telefone
        $numberDigits = ($cellPhone) ? 5 : 4;
        
        // Verifica se tem código do pais
        if(strlen($phoneNumber) > $totalNumber) {
            $countryCode   = substr($phoneNumber, 0, strlen($phoneNumber)-$totalNumber);
            $areaCode      = substr($phoneNumber, -$totalNumber, 2);
            $fristNumber   = substr($phoneNumber, -($totalNumber - 2), $numberDigits);
            $lastNumber    = substr($phoneNumber, -4, 4);
        
            $phoneNumber   = $countryCode.' ('.$areaCode.') '.$fristNumber.'-'.$lastNumber;
        
        // Verifica se tem código de area
        } else if(strlen($phoneNumber) == $totalNumber) {
            $areaCode    = substr($phoneNumber, 0, 2);
            $fristNumber = substr($phoneNumber, 2, $numberDigits);
            $lastNumber  = substr($phoneNumber, ($numberDigits + 2), 4);
        
            $phoneNumber = '('.$areaCode.') '.$fristNumber.'-'.$lastNumber;

        // Verifica se é só o telefone
        }
        else if(strlen($phoneNumber) == 8) {
            $fristNumber = substr($phoneNumber, 0, $numberDigits);
            $lastNumber  = substr($phoneNumber, 4, 4);
        
            $phoneNumber = $fristNumber.'-'.$lastNumber;
        }
        
        // Retorna o Phone formatado
        return $phoneNumber;
    }

    /**
     * Remove a formatação do Phone, reduzindo a apenas numeros
     *
     * @param string $phoneNumber
     * @return string
     */
    public static function unformat($phoneNumber)
    {
        // Remove tudo que não for numeros
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Verifica se sobrou numero para o Phone
        if (!empty($phoneNumber)) {
            return $phoneNumber;
        }

        // Se não achou um Phone possível retorna vazio
        return '';
    }
}
