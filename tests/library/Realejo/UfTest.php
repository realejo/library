<?php
/**
 * Uf test case
 */
use Realejo\Uf;

class UfTest extends PHPUnit_Framework_TestCase
{
    /**
     * Lista de UFs
     *
     * @todo pegar o array direto da classe UF
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
     *
     * @todo pegar o array direto da classe UF
     *
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
     * UFs e sua respectiva região geográfica
     *
     * @todo pegar o array direto da classe UF
     *
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
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();

        // TODO Auto-generated UfTest::setUp()

        $this->Uf = new Uf(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated UfTest::tearDown()

        $this->Uf = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Uf::getUfs()
     */
    public function testGetUfs ()
    {
        // TODO Auto-generated UfTest::testGetUfs()
        $this->markTestSkipped("getUfs test not implemented");

        Uf::getUfs(/* parameters */);

    }

    /**
     * Tests Uf::getUf()
     */
    public function testGetUf ()
    {
        // TODO Auto-generated UfTest::testGetUf()
        $this->markTestSkipped("getUf test not implemented");

        Uf::getUf(/* parameters */);

    }

    /**
     * Tests Uf::getRegioes()
     */
    public function testGetRegioes ()
    {
        // TODO Auto-generated UfTest::testGetRegioes()
        $this->markTestSkipped("getRegioes test not implemented");

        Uf::getRegioes(/* parameters */);

    }

    /**
     * Tests Uf::getUfRegiao()
     */
    public function testGetUfRegiao ()
    {
        // TODO Auto-generated UfTest::testGetUfRegiao()
        $this->markTestSkipped("getUfRegiao test not implemented");

        Uf::getUfRegiao(/* parameters */);

    }

}

