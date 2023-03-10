<?php

namespace MDZT\Leilao\Model;

use Stringable;

class Leilao
{
    /** @var Lance[]*/
    private $lances;
    /** @var string*/
    private $descricao;

    public function __construct(String $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        if(!empty($this->lances) && $lance->getUsuario() == $this->lances[count($this->lances) - 1]->getUsuario())
        {
            return;
        }
        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    private function lastUsuario(Lance $lance):bool
    {
        $ultimoLance = $this->lances[array_key_last($this->lances)];
        return $lance->getUsuario() == $ultimoLance->getUsuario();
    }

    private function qtdLancesUsuario(Usuario $usuario): int
    {
        $totalLancesUsuario = array_reduce(
            $this->lances,
            function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
                if($lanceAtual->getUsuario() == $usuario){
                    return $totalAcumulado + 1;
                }

                return $totalAcumulado;
            },
            0
        );

        return $totalLancesUsuario;
    }
}

?>