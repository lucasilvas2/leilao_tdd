<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require_once "vendor/autoload.php";

$leiao = new Leilao('Corsa preto');

$maria = new Usuario('Maria');
$joao = new Usuario('Joao');

$leiao->recebeLance(new Lance($maria, 2000));
$leiao->recebeLance(new Lance($joao, 3000));

$leioeiro = new Avaliador();
$leioeiro->avalia($leiao);

$maiorValor =  $leioeiro->getMaiorValor();

$valorEsperado = 2500;
if($maiorValor == $valorEsperado){
    echo "TEST OK";
}else{
    echo "TEST ERRO";
}

echo $maiorValor;