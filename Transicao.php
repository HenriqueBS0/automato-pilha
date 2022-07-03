<?php

class Transicao {

    private string $sEstado;
    private Closure $fnOperacao;

    public function __construct(string $sEstado, Closure $fnOperacao = null) {
        $this->setEstado($sEstado);
        $this->setOperacao($fnOperacao);
    }

    private function setEstado(string $sEstado) : void
    {
        $this->sEstado = $sEstado;
    }

    private function setOperacao(Closure|null $fnOperacao) : void
    {
        $this->fnOperacao = $fnOperacao ?: function(Pilha $oPilha) {};
    }

    public function getEstado() : string|null 
    {
        return $this->sEstado;
    }

    public function getOperacao() : Closure 
    {
        return $this->fnOperacao;
    }

}