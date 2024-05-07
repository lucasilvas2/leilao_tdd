<?php

namespace Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{

    /**
     * @param Leilao $leilao
     * @return void
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorEncontrarOMaiorValorLances(Leilao $leilao)
    {

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leilao);

        $maiorValor = $leioeiro->getMaiorValor();

        self::assertEquals(3000, $maiorValor);
    }

    /**
     * @param Leilao $leilao
     * @return void
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorEncontrarOMenorValorLances(Leilao $leilao)
    {

        $leioeiro = new Avaliador();
        $leioeiro->avalia($leilao);

        $menorValor = $leioeiro->getMenorValor();

        self::assertEquals(1700, $menorValor);
    }

    /**
     * @param Leilao $leilao
     * @return void
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorRetornaOs3MaioresLances(Leilao $leilao)
    {
        $leioeiro = new Avaliador();
        $leioeiro->avalia($leilao);

        $maioresLances = $leioeiro->getMaioresLances();

        self::assertCount(3, $maioresLances);
        self::assertEquals(3000, $maioresLances[0]->getValor());
        self::assertEquals(2000, $maioresLances[1]->getValor());
        self::assertEquals(1700, $maioresLances[2]->getValor());
    }

    public static function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 3000));

        return [
            'ordem-crescente' => [$leilao]
        ];
    }

    public static function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 3000));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($ana, 1700));

        return [
            'ordem-decrescente' => [$leilao]
        ];
    }

    public static function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 3000));
        $leilao->recebeLance(new Lance($ana, 1700));

        return [
            'ordem-aleatoria' => [$leilao]
        ];
    }

    public static function entregaLeiloes(): array
    {
        return [
            [self::leilaoEmOrdemCrescente()],
            [self::leilaoEmOrdemDecrescente()],
            [self::leilaoEmOrdemAleatoria()]
        ];
    }


}