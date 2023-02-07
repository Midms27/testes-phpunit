<?php

use MDZT\Leilao\Model\Lance;
use MDZT\Leilao\Model\Leilao;
use MDZT\Leilao\Model\Usuario;
use MDZT\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

//Criar cenário de testes - Arrange - Given
$leilao = new Leilao('Toyota Supra 1994 laranja');
$brian = new Usuario('Brian');
$toretto = new Usuario('Toretto');
$leilao->recebeLance(new Lance($toretto,50000));
$leilao->recebeLance(new Lance($brian,100000));
$leiloeiro = new Avaliador();
//Executa o código que será testado - Act - When
$leiloeiro->avalia($leilao);
$maiorValor = $leiloeiro->getMaiorValor();
//Verifica se a saída é a esperada - Assert - Then
$valorEsperado = 100000;
if ($valorEsperado == $maiorValor){
    echo "TESTE OK" . PHP_EOL;
} else {
    echo "TESTE ERROR" . PHP_EOL;
}

?>