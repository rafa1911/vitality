<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="img/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Treinos</title>
    <link rel="stylesheet" href="../../assets/css/treinoAL.css">

    <?php
    session_start();
    include '../../db/conexao.php';

    $id = $_SESSION['usuario_id'];
    $c = "n";

    $query = "SELECT t.numero_treino AS id_treino, t.tipo, ta.aparelho, ta.series,ta.carga, ta.repeticao, ta.descanso
          FROM treino t
          INNER JOIN treino_aparelho ta ON t.numero_treino = ta.numero_treino
          WHERE t.fk_aluno_id_aluno = ? 
            AND t.conclusao = ?
            AND t.numero_treino = (SELECT MIN(numero_treino)
                                    FROM treino
                                    WHERE fk_aluno_id_aluno = ? AND conclusao = ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isis", $id, $c, $id, $c);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $treinos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    ?>
</head>

<body>
    <a href="perfil_aluno.php" class="back-icon">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    
    <header class="header">
        <h1>Treinos</h1>
        <button class="start-button" onclick="iniciarTreino()">INICIAR TREINO</button>
        <p class="mode-message">Você está no "modo visualização". Aperte INICIAR para começar o treino.</p>
    </header>

    <!-- Container para as informações de treino -->
    <div class="container">
        <section class="exercises">
            <?php if (!empty($treinos)) : ?>
                <?php foreach ($treinos as $treino) : ?>
                    <div class="exercise">
    <h2><?= htmlspecialchars($treino['tipo']); ?></h2>
    <p>Aparelho: <?= htmlspecialchars($treino['aparelho']); ?></p>
    <p>Séries: <?= htmlspecialchars($treino['series']); ?></p>
    <p>Repetições: <?= htmlspecialchars($treino['repeticao']); ?></p>
    <p>Descanso: <?= htmlspecialchars($treino['descanso']); ?> segundos</p>

    <div class="exercise-video">
      <?php
    // Gera o caminho do GIF dinamicamente
    $aparelho_formatado = strtolower(str_replace(' ', '_', $treino['aparelho']));
    $gif_path = "../../assets/gifs/{$aparelho_formatado}.gif";
    ?>
    
<video width="320" height="240" controls autoplay loop muted src="<?php
    switch ($treino['aparelho']) {
        case "Supino Inclinado com Halteres":
            echo "../../assets/gifs/Supino_inclinado_halteres.mp4";
            break;
        case "Crucifixo na Máquina":
            echo "../../assets/gifs/Crucifixo_na_maquina.mp4";
            break;
        case "Puxada Alta com Triângulo":
            echo "../../assets/gifs/Puxada_alta_com_triangulo.mp4";
            break;
        case "Remada Baixa com Triângulo":
            echo "../../assets/gifs/Remada_baixa_com_triangulo.mp4";
            break;
        case "Elevação Lateral":
            echo "../../assets/gifs/Elevacao_lateral.mp4";
            break;
        case "Desenvolvimento com Halteres":
            echo "../../assets/gifs/Desenvolvimento_com_halteres.mp4";
            break;
        case "Puxador Tríceps com Corda":
             echo "../../assets/gifs/Puxador_triceps_com_corda.mp4";
             break;
        case "Triceps Francês com Halter":
              echo "../../assets/gifs/Triceps_frances_com_halter.mp4";
             break;
        case "Rosca Direta com Barra":
               echo "../../assets/gifs/Rosca_direta_com_barra.mp4";
               break;
        case "Rosca Martelo com Halteres":
                 echo "../../assets/gifs/Rosca_martelo_com_halteres.mp4";
                   break;
        case "Leg Press 45°":
                  echo "../../assets/gifs/leg_press_45°.mp4";
                       break;
        case "Cadeira extensora":
                      echo "../../assets/gifs/cadeira_extensora.mp4";
                         break;
        case "Stiff com Barra":
                           echo "../../assets/gifs/stiff_com_barra.mp4";
                           break;
        case "Cadeira Flexora":
                    echo "../../assets/gifs/cadeira_flexora.mp4";
                    break;
        case "Elevação Pélvica na Máquina":
                      echo "../../assets/gifs/elevacao_pelvica_maquina.mp4";
                            break;
        case "Cadeira Abdutora":
                          echo "../../assets/gifs/cadeira_abdutora.mp4";
                                break;
        case "Sóleo Máquina":
                echo "../../assets/gifs/soleo_maquina.mp4";
                   break;
        case "Panturrilha em pé na máquina":
                  echo "../../assets/gifs/panturrilha_em_pe_maquina.mp4";
                       break;
        case "Abdominal Infra":   
                     echo "../../assets/gifs/abdominal_infra.mp4";
                       break;
         case "Abdominal Oblíquo":
                   echo "../../assets/gifs/abdominal_obliquo.mp4";
                        break;
        default:
            echo "../../assets/gifs/cadeira_flexora.mp4";
            break;
    }
?>" alt="GIF do aparelho"> </video>

</div>
</div>

                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-exercise">
                    <!-- Popup -->
                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <p>Nenhum treino encontrado. Aguarde o personal enviar o treino.</p>
                            <button class="close-button" onclick="closePopup()">Fechar</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <a href="../../controllers/finaliza_treino.php?id_treino=<?php echo $treino['id_treino']?>">
            <button class="finish-button" style="display: none;" onclick="finalizarTreino()">FINALIZAR TREINO</button>
        </a>
    </div>

    <script src="../../assets/js/treino.js"></script>
</body>

</html>

<script>
    window.onload = function() {
        if (document.querySelector(".no-exercise")) {
            document.getElementById("popup").style.display = "flex"; // Mostrar o popup automaticamente ao carregar
        }
    };

    function iniciarTreino() {
        document.querySelector(".start-button").style.display = "none";
        document.querySelector(".mode-message").textContent = "Treino em andamento. Complete os exercícios abaixo.";
        document.querySelector(".finish-button").style.display = "block";

        const exercises = document.querySelectorAll(".exercise");
        exercises.forEach(exercise => {
            exercise.classList.add("active");
        });
    }

    function finalizarTreino() {
        alert("Parabéns! Você completou o treino.");
        document.querySelector(".finish-button").style.display = "none";
        document.querySelector(".mode-message").textContent = "Você completou o treino.";
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    
</script>