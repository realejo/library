<?php
/**
 * Classe para gerenciamente de UFs e Regiões geográficas
 *
 * Não se chama estado pois DF não é estado
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class Uf
{
    /**
     * Lista de UFs e seus nomes por extenso
     *
     * @var array
     */
    protected $uf = array(
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AM' => 'Amazonas',
                    'AP' => 'Amapá',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MS' => 'Mato Grosso do Sul',
                    'MT' => 'Mato Grosso',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondonia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins'
                );

    /**
     * Regiões geográficas
     * @var array
     */
    protected $regioes = array(
                            'CO' => 'Centro-Oeste',
                            'NO' => 'Norte',
                            'NE' => 'Nordeste',
                            'SE' => 'Sudeste',
                            'SU' => 'Sul'
                        );

    /**
     * Lista de UFs e sua respectiva região geográfica
     * @var array
     */
    protected $ufRegiao = array (
                    		'AC' => 'NO',
                    		'AL' => 'NE',
                    		'AM' => 'NO',
                    		'AP' => 'NO',
                    		'BA' => 'NE',
                    		'CE' => 'NE',
                    		'DF' => 'CO',
                    		'ES' => 'SE',
                    		'GO' => 'CO',
                    		'MA' => 'NE',
                    		'MS' => 'CO',
                    		'MT' => 'CO',
                    		'MG' => 'SE',
                    		'PA' => 'NO',
                    		'PB' => 'NE',
                    		'PR' => 'SU',
                    		'PE' => 'NE',
                    		'PI' => 'NE',
                    		'RJ' => 'SE',
                    		'RN' => 'NE',
                    		'RS' => 'SU',
                    		'RO' => 'NO',
                    		'RR' => 'NO',
                    		'SC' => 'SU',
                    		'SP' => 'SE',
                    		'SE' => 'NE',
                    		'TO' => 'SU'
                        );

    /**
     * Retorna as Ufs
     *
     * @param array|string $regiao OPCIONAL Região geográfica, se informado retorna apenas as UFs da região
     *
     * @return array
     */
    static public function getUfs($regiao = null)
    {
        $oSelf = new self();
        if (empty($regiao)) {
            return $oSelf->uf;
        } else {
            $ufs = array();
            if (!is_array($regiao)) $regiao = array($regiao);
            foreach ($regiao as $r) {
                foreach ($oSelf->uf as $u=>$nome) {
                    if (isset($oSelf->UfRegiao[$u]) && $oSelf->UfRegiao[$u] == $r) {
                        $ufs[$u] = $nome;
                    }
                }
            }
            return $ufs;
        }
    }

    /**
     * Retorna o nome da UF
     *
     * @return array
     */
    static public function getUf($uf)
    {
        $oSelf = new self();
        return $oSelf->regioes;
    }

    /**
     * Retorna as regiões geográficas
     *
     * @return array
     */
    static public function getRegioes()
    {
        $oSelf = new self();
        return $oSelf->regioes;
    }

    /**
     * Retorna as UF e a região a qual pertence
     *
     * @return array
     */
    static public function getUfRegiao()
    {
        $oSelf = new self();
        return $oSelf->ufRegiao;
    }
}