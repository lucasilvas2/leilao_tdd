<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;
    private $maioresLances;
    public function avalia(Leilao $leilao): void
    {
        foreach ($leilao->getLances() as $leilaoLance) {
            if ($leilaoLance->getValor() > $this->maiorValor) {
                $this->maiorValor = $leilaoLance->getValor();
            }
            if ($leilaoLance->getValor() < $this->menorValor) {
                $this->menorValor = $leilaoLance->getValor();
            }
        }

        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2) {
            return $lance2->getValor() -  $lance1->getValor();
        });

        $this->maioresLances = array_slice($lances, 0, 3);
    }

    /**
     * @return mixed
     */
    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    /**
     * @return mixed
     */
    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }

}