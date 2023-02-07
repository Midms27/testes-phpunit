<?php

namespace MDZT\Leilao\Test\Model;
use MDZT\Leilao\Model\{Lance,Usuario,Leilao};
use PHPUnit\Framework\TestCase;


class LeilaoText extends TestCase
{
    public function generateLance()
    {
        $brian = new Usuario('Brian');
        $toretto = new Usuario('Toretto');
        $hobbs = new Usuario('Hobbs');

        $leilao3 = new Leilao('Dodge Charger R/T 1970');
        $leilao3->recebeLance(new Lance($toretto,500000));
        $leilao3->recebeLance(new Lance($brian,400000));
        $leilao3->recebeLance(new Lance($hobbs,100000));

        $leilao2 = new Leilao('Toyota Supra 1994 laranja');
        $leilao2->recebeLance(new Lance($toretto,500000));
        $leilao2->recebeLance(new Lance($brian,400000));

        $leilao1 = new Leilao('Lykan HyperSport');
        $leilao1->recebeLance(new Lance($toretto,500000));

        return [
            '3-lances' => [3, $leilao3, [500000,400000,100000]],
            '2-lances' =>[2, $leilao2, [500000,400000]],
            '1-lance' => [1, $leilao1, [500000]]
        ];

    }

    /**
     * 
     * @dataProvider generateLance
     * 
     */

    public function testRecebeLances(int $qtdLances, Leilao $leilao, array $valores)
    {
        static::assertCount($qtdLances, $leilao->getLances());
        foreach($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function testRepeticao()
    {
        $leilao = new Leilao('Lamborghini Aventador');

        $toretto = new Usuario('Toretto');
        $leilao->recebeLance(new Lance($toretto,500000));
        $leilao->recebeLance(new Lance($toretto,500000));

        static::assertCount(1, $leilao->getLances());
        static::assertEquals(500000, $leilao->getLances()[0]->getValor());
    }

    public function testCincoLances()
    {
        $leilao = new Leilao('Lamborghini Aventador');

        $brian = new Usuario('Brian');
        $toretto = new Usuario('Toretto');

        $leilao->recebeLance(new Lance($toretto,400000));
        $leilao->recebeLance(new Lance($brian,500000));
        $leilao->recebeLance(new Lance($toretto,550000));
        $leilao->recebeLance(new Lance($brian,600000));
        $leilao->recebeLance(new Lance($toretto,650000));
        $leilao->recebeLance(new Lance($brian,70000));
        $leilao->recebeLance(new Lance($toretto,750000));
        $leilao->recebeLance(new Lance($brian,800000));
        $leilao->recebeLance(new Lance($toretto,850000));
        $leilao->recebeLance(new Lance($brian,900000));


        static::assertCount(10, $leilao->getLances());
        static::assertEquals(900000, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());
    }
}
    

    

?>