<?php

require_once('Pilha.php');
require_once('EstadoFinal.php');

class AutomatoPilha {
    
    #region Atributos

    private Pilha $oPilha;
    
    /** @var string[] */
    private array $aEstados;

    /** @var string[] */
    private array $aAlfabetoEntrada;

    /** @var string[] */
    private array $aAlfabetoPilha;

    private string $sEstadoInicial;

    /** @var EstadoFinal[] */
    private array $aEstadosFinais;

    /** @var array array[estado][entrada][topoPilha][Transicao] */
    private array $aTransicoes;

    #endregion
    
    #region Construtor

    public function __construct(
        array $aEstados, 
        array $aAlfabetoEntrada, 
        array $aAlfabetoPilha, 
        string $sEstadoInicial, 
        string $sElementoInicial,   
        array $aEstadosFinais,
        array $aTransicoes
    ) 
    {
        $this->setEstados($aEstados);
        $this->setAlfabetoEntrada($aAlfabetoEntrada);
        $this->setAlfabetoPilha($aAlfabetoPilha);
        $this->setEstadoInicial($sEstadoInicial);
        $this->setPilha(new Pilha($sElementoInicial));
        $this->setEstadosFinais($aEstadosFinais);
        $this->setTransicoes($aTransicoes);
    }

    #endregion

    #region Setters
    private function setPilha(Pilha $oPilha) : void 
    {
        $this->oPilha = $oPilha;
    }
    
    private function setEstados(array $aEstados) : void 
    {
        $this->aEstados = $aEstados;
    }
    
    private function setAlfabetoEntrada(array $aAlfabetoEntrada) : void 
    {
        $this->aAlfabetoEntrada = $aAlfabetoEntrada;
    }
    
    private function setAlfabetoPilha(array $aAlfabetoPilha) : void 
    {
        $this->aAlfabetoPilha = $aAlfabetoPilha;
    }
    
    private function setEstadoInicial(string $sEstadoInicial) : void 
    {
        $this->sEstadoInicial = $sEstadoInicial;
    }
    
    private function setEstadosFinais(array $aEstadosFinais) : void 
    {
        $this->aEstadosFinais = $aEstadosFinais;
    }

    private function setTransicoes(array $aTransicoes) : void
    {
        $this->aTransicoes = $aTransicoes;
    }

    #endregion

    #region Getters

    private function getPilha() : Pilha
    {
        return $this->oPilha;
    }
    
    private function getEstados() : array
    {
        return $this->aEstados;
    }

    private function getAlfabetoEntrada() : array
    {
        return $this->aAlfabetoEntrada;
    }

    private function getAlfabetoPilha() : array
    {
        return $this->aAlfabetoPilha;
    }

    private function getEstadoInicial() : string
    {
        return $this->sEstadoInicial;
    }

    private function getEstadosFinais() : array
    {
        return $this->aEstadosFinais;
    }

    private function getTransicoes() : array
    {
        return $this->aTransicoes;
    }

    #endregion

    #region Métodos

    public function getTipoEntrada(string $sEntrada) {

    }

    #endregion
}