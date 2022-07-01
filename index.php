<?php

require_once('Transicao.php');
require_once('AutomatoPilha.php');

$aTransicoes = [
    'q' => [
        '0'    => [
            'null' => new Transicao('q', Transicao::OPERACAO_INSERIR, 'X'),
            'X'    => new Transicao('q', Transicao::OPERACAO_INSERIR, 'X'),
        ] ,
        '1'    => [
            'X'    => new Transicao('p', Transicao::OPERACAO_REMOVER),
        ]
    ],
    'p' => [
        '1'    => [
            'X'    => new Transicao('p', Transicao::OPERACAO_REMOVER) 
        ],
        'null' => [
            'null' => new Transicao('f')
        ]   
    ]
];

$sEstadoFinal = 'f';

$oAutomato = new AutomatoPilha($aTransicoes, $sEstadoFinal);

