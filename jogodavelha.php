<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Velha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        #tabuleiro {
            border-collapse: collapse;
        }
        #tabuleiro td {
            width: 100px;
            height: 100px;
            text-align: center;
            font-size: 36px;
            border: 2px solid #555;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #tabuleiro td:hover {
            background-color: #ddd;
        }
        #mensagem {
            margin-top: 20px;
            font-size: 24px;
        }
    </style>
</head>
<body>

<table id="tabuleiro">
    <?php
    $tabuleiro = array(
        array('-', '-', '-'),
        array('-', '-', '-'),
        array('-', '-', '-')
    );

    for ($i = 0; $i < 3; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 3; $j++) {
            echo "<td onclick='fazerJogada($i, $j)'>" . $tabuleiro[$i][$j] . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<div id="mensagem"></div>

<script>
    var jogador = 'X';
    var rodada = 1;
    var tabuleiro = <?php echo json_encode($tabuleiro); ?>; // Convertendo o tabuleiro PHP para JavaScript

    function fazerJogada(linha, coluna) {
        if (tabuleiro[linha][coluna] == '-') {
            tabuleiro[linha][coluna] = jogador;
            document.getElementById('tabuleiro').rows[linha].cells[coluna].innerHTML = jogador;

            if (verificarVencedor(jogador)) {
                document.getElementById('mensagem').innerHTML = "Jogador " + jogador + " venceu!";
                bloquearJogadas();
            } else if (rodada == 9) {
                document.getElementById('mensagem').innerHTML = "Empate!";
                bloquearJogadas();
            } else {
                jogador = (jogador == 'X') ? 'O' : 'X';
                rodada++;
            }
        } else {
            alert("Posição ocupada, escolha outra!");
        }
    }

    function verificarVencedor(jogador) {
        // Verificar linhas e colunas
        for (var i = 0; i < 3; i++) {
            if (tabuleiro[i][0] == jogador && tabuleiro[i][1] == jogador && tabuleiro[i][2] == jogador) {
                return true;
            }
            if (tabuleiro[0][i] == jogador && tabuleiro[1][i] == jogador && tabuleiro[2][i] == jogador) {
                return true;
            }
        }

        // Verificar diagonais
        if (tabuleiro[0][0] == jogador && tabuleiro[1][1] == jogador && tabuleiro[2][2] == jogador) {
            return true;
        }
        if (tabuleiro[0][2] == jogador && tabuleiro[1][1] == jogador && tabuleiro[2][0] == jogador) {
            return true;
        }

        return false;
    }

    function bloquearJogadas() {
        var cells = document.querySelectorAll('#tabuleiro td');
        cells.forEach(function(cell) {
            cell.onclick = null;
        });
    }
</script>

</body>
</html>
