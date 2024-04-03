<?php

// Função para exibir o tabuleiro
function exibirTabuleiro($tabuleiro) {
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            echo $tabuleiro[$i][$j] . " ";
        }
        echo "<br>";
    }
}

// Função para verificar o vencedor
function verificarVencedor($tabuleiro, $jogador) {
    // Verificar linhas e colunas
    for ($i = 0; $i < 3; $i++) {
        if ($tabuleiro[$i][0] == $jogador && $tabuleiro[$i][1] == $jogador && $tabuleiro[$i][2] == $jogador) {
            return true;
        }
        if ($tabuleiro[0][$i] == $jogador && $tabuleiro[1][$i] == $jogador && $tabuleiro[2][$i] == $jogador) {
            return true;
        }
    }
    
    // Verificar diagonais
    if ($tabuleiro[0][0] == $jogador && $tabuleiro[1][1] == $jogador && $tabuleiro[2][2] == $jogador) {
        return true;
    }
    if ($tabuleiro[0][2] == $jogador && $tabuleiro[1][1] == $jogador && $tabuleiro[2][0] == $jogador) {
        return true;
    }
    
    return false;
}

// Inicializar tabuleiro
$tabuleiro = array(
    array('-', '-', '-'),
    array('-', '-', '-'),
    array('-', '-', '-')
);

$jogador = 'X';
$rodada = 1;

while (true) {
    // Exibir tabuleiro
    echo "Rodada: $rodada<br>";
    exibirTabuleiro($tabuleiro);
    
    // Solicitar jogada
    echo "É a vez do jogador $jogador<br>";
    echo "Digite a linha (0-2): ";
    $linha = readline();
    echo "Digite a coluna (0-2): ";
    $coluna = readline();
    
    // Verificar se a posição está ocupada
    if ($tabuleiro[$linha][$coluna] != '-') {
        echo "Posição ocupada, tente novamente!<br>";
        continue;
    }
    
    // Fazer a jogada
    $tabuleiro[$linha][$coluna] = $jogador;
    
    // Verificar se alguém ganhou
    if (verificarVencedor($tabuleiro, $jogador)) {
        echo "Jogador $jogador venceu!<br>";
        exibirTabuleiro($tabuleiro);
        break;
    }
    
    // Verificar se houve empate
    $empate = true;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($tabuleiro[$i][$j] == '-') {
                $empate = false;
                break 2;
            }
        }
    }
    if ($empate) {
        echo "Empate!<br>";
        exibirTabuleiro($tabuleiro);
        break;
    }
    
    // Alternar jogador
    $jogador = ($jogador == 'X') ? 'O' : 'X';
    $rodada++;
}
?>
