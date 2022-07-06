<?php

require_once('Pilha.php');

class AutomatoPilha {

    const ESTADO_VAZIO = 'VAZIO';
    
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

    public function getEstadoFinal(string $sEntrada) : string 
    {
        $aCaracteres = str_split($sEntrada);
        $aCaracteres[] = self::ESTADO_VAZIO;
        $sEstadoAtual = $this->getEstadoInicial();
        $oPilha = $this->getPilha();

        foreach ($aCaracteres as $sCaracter) {
            $this->validarCaracterEntrada($sCaracter);
            
            $oTransicao = $this->getTransicao($sEstadoAtual, $sCaracter, $oPilha->getTopo());
            $sEstadoAtual = $oTransicao->getEstado();

            $this->validarEstadoAtual($sEstadoAtual);

            call_user_func($oTransicao->getOperacao(), $oPilha);

            $this->validarCaracteresPilha($oPilha);
        }

        if(!$oPilha->isPilhaVazia()) {
           throw new Exception("Chegou ao fim da entrada e a pilha não está vazia.");
        }

        if(!in_array($sEstadoAtual, $this->getEstadosFinais())) {
            throw new Exception("O estado {$sEstadoAtual} não pertence ao conjunto de estados finais.");
        }

        return $sEstadoAtual;
    }

    private function validarCaracterEntrada(string $sCaracter) {
        if($sCaracter !== self::ESTADO_VAZIO && !in_array($sCaracter, $this->getAlfabetoEntrada())) {
            throw new Exception("Caracter {$sCaracter} não está no alfabeto de entrada.");
        }
    }

    private function validarEstadoAtual(string $sEstado) {
        if(!in_array($sEstado, $this->getEstados())) {
            throw new Exception("O estado {$sEstado} não pertence ao conjunto de estados do automato.");
        }
    }

    private function validarCaracteresPilha(Pilha $oPilha) {
        foreach($oPilha->getElementos() as $sElemento) {
            if(!in_array($sElemento, $this->getAlfabetoPilha())) {
                throw new Exception("Elemento {$sElemento} não está no alfabeto da pilha.");
            }
        }
    }

    private function getTransicao(string $sEstadoAtual, string $sCaracter, string $sTopoPilha) : Transicao 
    {

        $aTransicoes = $this->getTransicoes();

        if(!isset($aTransicoes[$sEstadoAtual])) {
            throw new Exception("Estado {$sEstadoAtual} não existe.");
        }

        if(!isset($aTransicoes[$sEstadoAtual][$sCaracter])) {
            throw new Exception("O caracter {$sCaracter} não está previsto para o estado {$sEstadoAtual}");
        }

        if(!isset($aTransicoes[$sEstadoAtual][$sCaracter][$sTopoPilha])) {
            throw new Exception("O topo da pilha {$sTopoPilha} não está previsto para o caracter {$sCaracter} e estado {$sEstadoAtual}");
        }

        return $aTransicoes[$sEstadoAtual][$sCaracter][$sTopoPilha];
    }

    #endregion
}