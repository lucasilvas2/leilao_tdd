<?php

namespace Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorEncontrarOMaiorValorLancesCrescentes()
    {
        $leiao = new Leilao('Corsa preto');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');

        $leiao->recebeLance(new Lance($maria, 2000));
        $leiao->recebeLance(new Lance($joao, 3000));

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leiao);

        $maiorValor = $leioeiro->getMaiorValor();

        self::assertEquals(3000, $maiorValor);
    }
    public function testAvaliadorEncontrarOMaiorValorLancesDescrecentes()
    {
        $leiao = new Leilao('Corsa preto');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');

        $leiao->recebeLance(new Lance($joao, 3000));
        $leiao->recebeLance(new Lance($maria, 2000));

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leiao);

        $maiorValor = $leioeiro->getMaiorValor();

        self::assertEquals(3000, $maiorValor);
    }

    public function testAvaliadorEncontrarOMenorValorLancesDescrecentes()
    {
        $leiao = new Leilao('Corsa preto');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');

        $leiao->recebeLance(new Lance($joao, 3000));
        $leiao->recebeLance(new Lance($maria, 2000));

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leiao);

        $menorValor = $leioeiro->getMenorValor();

        self::assertEquals(2000, $menorValor);
    }

    public function testAvaliadorEncontrarOMenorValorLancesCrescentes()
    {
        $leiao = new Leilao('Corsa preto');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');

        $leiao->recebeLance(new Lance($maria, 2000));
        $leiao->recebeLance(new Lance($joao, 3000));

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leiao);

        $menorValor = $leioeiro->getMenorValor();

        self::assertEquals(2000, $menorValor);
    }

    public function testAvaliadorRetornaOs3MaioresLances()
    {
        $leiao = new Leilao('Corsa preto');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        $pedro = new Usuario('Pedro');
        $joana = new Usuario('Joana');

        $leiao->recebeLance(new Lance($maria, 2000));
        $leiao->recebeLance(new Lance($joao, 3000));
        $leiao->recebeLance(new Lance($pedro, 1000));
        $leiao->recebeLance(new Lance($joana, 1500));

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leiao);

        $maioresLances = $leioeiro->getMaioresLances();

        self::assertCount(3, $maioresLances);
        self::assertEquals(3000, $maioresLances[0]->getValor());
        self::assertEquals(2000, $maioresLances[1]->getValor());
        self::assertEquals(1500, $maioresLances[2]->getValor());
    }

}