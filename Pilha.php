<?php

class Pilha {

    private array $aElementos = [];

    public function __construct(string $sElementoInicial) {
        $this->inserir($sElementoInicial);
    }

    public function getElementos() : array 
    {
        return $this->aElementos;
    }

    private function setElementos(array $aElementos)  : void
    {
        $this->aElementos = $aElementos;
    }

    private function getNumeroElementos() : int
    {
        return count($this->getElementos());
    }

    public function isPilhaVazia() : bool
    {
        return $this->getNumeroElementos() === 1;
    }

    public function getTopo() : string
    {
        return $this->getElementos()[$this->getNumeroElementos() - 1];
    }

    public function inserir(string $xElemento) : void
    {
        $aElementos = $this->getElementos();
        $aElementos[] = $xElemento;

        $this->setElementos($aElementos);
    }

    public function remover() {
        if($this->isPilhaVazia()) {
            throw new Exception('Falha ao remover elemento da pilha. A Pilha está em seu elemento inicial.');
        }

        $aElementos = $this->getElementos();

        unset($aElementos[count($aElementos) - 1]);

        $this->setElementos($aElementos);
    }
}