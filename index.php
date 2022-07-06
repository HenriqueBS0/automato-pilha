<?php

require_once('Transicao.php');
require_once('AutomatoPilha.php');


$empilharXX = function(Pilha $oPilha) {
    $oPilha->inserir('X');
    $oPilha->inserir('X');
};

$desempilharX = function(Pilha $oPilha) {
    $oPilha->remover();
};

$aEstados = ['q', 'p', 'f'];
$aAlfabetoEntrada = ['a', 'b'];
$aAlfabetoPilha = ['Z', 'X'];
$sEstadoInicial = 'q';
$sElementoInicial = 'Z';
$aEstadosFinais = ['f'];
$aTransicoes = [
    'q' => [
        'a' => [
            'Z' => new Transicao('q', $empilharXX),
            'X' => new Transicao('q', $empilharXX),
        ],
        'b' => [
            'X' => new Transicao('p', $desempilharX),
        ]
    ], 
    'p' => [
        'b' => [
            'X' => new Transicao('p', $desempilharX),
        ],
        AutomatoPilha::ESTADO_VAZIO => [
            'Z' => new Transicao('f'),
        ]
    ]
];

$oAutomato = new AutomatoPilha($aEstados, $aAlfabetoEntrada, $aAlfabetoPilha, $sEstadoInicial, $sElementoInicial, $aEstadosFinais, $aTransicoes);

$sEntrada = 'abb';

$aDescritivoEstadosFinais = ['f' => 'Aceitou Entrada!'];

try {
    echo  $aDescritivoEstadosFinais[$oAutomato->getEstadoFinal($sEntrada)];
} catch (Exception $oEx) {
    echo $oEx->getMessage();
}