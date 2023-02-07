<?php

namespace MDZT\Leilao\Test\Service;
use MDZT\Leilao\Model\{Usuario, Lance, Leilao};
use MDZT\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    //Arrange

    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    public function leilaoSupra()
    {
        $leilao = new Leilao('Toyota Supra 1994 laranja');

        $brian = new Usuario('Brian');
        $toretto = new Usuario('Toretto');
        $hobbs = new Usuario('Hobbs');

        $leilao->recebeLance(new Lance($toretto,400000));
        $leilao->recebeLance(new Lance($brian,100000));
        $leilao->recebeLance(new Lance($hobbs,500000));

        return [
            'leilao-supra' => [$leilao]
        ];
    }

    public function leilaoDodge()
    {
        $leilao = new Leilao('Dodge Charger R/T 1970');

        $brian = new Usuario('Brian');
        $toretto = new Usuario('Toretto');
        $hobbs = new Usuario('Hobbs');

        $leilao->recebeLance(new Lance($toretto,500000));
        $leilao->recebeLance(new Lance($brian,400000));
        $leilao->recebeLance(new Lance($hobbs,100000));

        return [
            'leilao-dodge' => [$leilao]
        ];
    }
    
    public function leilaoLykan()
    {
        $leilao = new Leilao('Lykan HyperSport');

        $brian = new Usuario('Brian');
        $toretto = new Usuario('Toretto');
        $shaw = new Usuario('Shaw');
        $hobbs = new Usuario('Hobbs');

        $leilao->recebeLance(new Lance($toretto,500000));
        $leilao->recebeLance(new Lance($brian,400000));
        $leilao->recebeLance(new Lance($shaw,100000));
        $leilao->recebeLance(new Lance($hobbs,100000));

        return [
            'leilao-lykan' => [$leilao]
        ];
    }


    // Act/Assert

    /**
     * 
     * @dataProvider leilaoSupra
     * @dataProvider leilaoDodge
     * @dataProvider leilaoLykan
     * 
     */
    
    public function testGetMaiorValor(Leilao $leilao)
    {
        
        //Executa o código que será testado - Act - When
        $this->leiloeiro->avalia($leilao);
        $maiorValor = $this->leiloeiro->getMaiorValor();
        //Verifica se a saída é a esperada - Assert - Then
        self::assertEquals(500000,$maiorValor);
        
    }

    /**
     * 
     * @dataProvider leilaoSupra
     * @dataProvider leilaoDodge
     * @dataProvider leilaoLykan
     * 
     */

    public function testGetMenorValor(Leilao $leilao)
    {
        //Executa o código que será testado - Act - When
        $this->leiloeiro->avalia($leilao);
        $menorValor = $this->leiloeiro->getMenorValor();
        //Verifica se a saída é a esperada - Assert - Then
        self::assertEquals(100000,$menorValor);
    }

    /**
     * 
     * @dataProvider leilaoSupra
     * @dataProvider leilaoDodge
     * @dataProvider leilaoLykan
     * 
     */

    public function test3MaioresValores(Leilao $leilao) 
    {

        //Act
        $this->leiloeiro->avalia($leilao);
        $maioresLances = $this->leiloeiro->getMaioresLances();
        //Assert
        static::assertCount(3,$maioresLances);
        static::assertEquals(500000, $maioresLances[0]->getValor());
        static::assertEquals(400000, $maioresLances[1]->getValor());
        static::assertEquals(100000, $maioresLances[2]->getValor());
    }

}

?>