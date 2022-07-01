<?php

class Transicao {

    /**
     * Operaçòes Possíveis
     */
    const OPERACAO_INSERIR = 'inserir';
    const OPERACAO_REMOVER = 'remover';

    private string $sEstado;
    private string|null $fnOperacao;
    private string|null $sElementoInsercao;

    public function __construct(string $sEstado, string|null $fnOperacao = null, string $sElementoInsercao = null) {
        $this->setEstado($sEstado);
        $this->setOperacao($fnOperacao);
        $this->setElementoInsercao($sElementoInsercao);
    }

    private function setEstado(string $sEstado) : void
    {
        $this->sEstado = $sEstado;
    }

    private function setOperacao(string|null $fnOperacao) : void
    {
        $this->fnOperacao = $fnOperacao;
    }

    private function setElementoInsercao(string|null $sElementoInsercao) : void
    {
        $this->sElementoInsercao = $sElementoInsercao;
    }

    public function getEstado() : string|null 
    {
        return $this->sEstado;
    }

    public function getOperacao() : string|null 
    {
        return $this->fnOperacao;
    }

    public function getElementoInsercao() : string
    {
        return $this->sElementoInsercao;
    }
}