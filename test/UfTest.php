<?php

namespace RealejoTest;

/**
 * Uf test case
 */
use Realejo\Uf;

class UfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Lista de UFs
     *
     * @todo pegar o array direto da classe UF
     *
     * @var array
     */
    protected $uf = [
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
    ];

    /**
     * Regiões geográficas
     *
     * @todo pegar o array direto da classe UF
     *
     * @var array
     */
    protected $regioes = [
            'CO' => 'Centro-Oeste',
            'NO' => 'Norte',
            'NE' => 'Nordeste',
            'SE' => 'Sudeste',
            'SU' => 'Sul'
    ];

    /**
     * UFs e sua respectiva região geográfica
     *
     * @todo pegar o array direto da classe UF
     *
     * @var array
     */
    protected $ufRegiao = [
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
            'TO' => 'NO'
    ];


    /**
     * Tests Uf::getUfs()
     */
    public function testGetUfs()
    {
        $this->assertEquals(array_keys($this->ufRegiao), array_keys(Uf::getUfs()));
        $this->assertEquals(['ES', 'MG', 'RJ', 'SP'], array_keys(Uf::getUfs('SE')));
    }

    /**
     * Tests Uf::getUf()
     */
    public function testGetUf()
    {
        $this->assertEquals('Rio de Janeiro', Uf::getUf('RJ'));
        $this->assertNull(Uf::getUf('XX'));
    }

    /**
     * Tests Uf::getRegioes()
     */
    public function testGetRegioes()
    {
        $this->assertInternalType('array', Uf::getRegioes());
        $this->assertCount(5, Uf::getRegioes());
        $this->assertEquals([
            'CO' => 'Centro-Oeste',
            'NO' => 'Norte',
            'NE' => 'Nordeste',
            'SE' => 'Sudeste',
            'SU' => 'Sul'
        ], Uf::getRegioes());
    }

    /**
     * Tests Uf::getUfRegiao()
     */
    public function testGetUfRegiao()
    {
        $this->assertEquals($this->ufRegiao, Uf::getUfRegiao());
    }
}
