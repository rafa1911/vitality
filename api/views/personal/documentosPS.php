<?php
session_start();
include '../../db/conexao.php';

if (isset($_SESSION['id_aluno'])) {
    $id_aluno = $_SESSION['id_aluno'];

    $query_documentos = "SELECT tipo_documento, documento FROM solicitacoes WHERE fk_aluno_id_aluno = ? AND status = 'baixada'";
    $stmt_documentos = $conn->prepare($query_documentos);

    if ($stmt_documentos) {
        $stmt_documentos->bind_param("i", $id_aluno);
        $stmt_documentos->execute();
        $result_documentos = $stmt_documentos->get_result();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
        exit;
    }
} else {
    echo "ID do aluno não definido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="../../assets/img/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="../../assets/css/documentosPS.css">
    <title>Documentos</title>
    <style>

        /* Estilo para o container de documentos no canto direito */
        .documentos-respondidos {
            position: fixed;
            top: 80px;
            right: 20px;
            width: 300px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-height: 400px;
        }

        .documentos-respondidos h2 {
            font-size: 18px;
            color: #ff004f;
            margin-bottom: 10px;
        }

        .documento-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .documento-item:hover {
            background: #f9f9f9;
        }

        .documento-item span {
            font-size: 14px;
            color: #555;
        }

        .documento-item .view-icon {
            color: #FF004f;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s;
        }

        .documento-item .view-icon:hover {
            color: #F5004F;
        }
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            padding: 40px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            width: 500px;
            max-width: 90%;
            overflow-y: auto;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #333;
            cursor: pointer;
            background: transparent;
            border: none;
        }

        .popup-content ul {
            list-style-type: none;
            padding: 0;
        }

        .popup-content li {
            margin: 10px 0;
            text-align: left;
        }

        .popup-content h2 {
            margin-bottom: 20px;
        }
        button {
    background-color: #FFAF00; /* Cor de fundo amarelo */
    color: white; /* Cor do texto */
    border: none; /* Remove bordas */
    padding: 10px 20px; /* Espaçamento interno */
    font-size: 16px; /* Tamanho da fonte */
    cursor: pointer; /* Aponta o cursor para indicar que é clicável */
    border-radius: 5px; /* Cantos arredondados */
}

/* Estilo do modal */
#documentModal {
    display: none; /* Inicialmente escondido */
    position: fixed;
    top: 10%; /* Faz o modal aparecer um pouco mais acima no centro da tela */
    left: 50%;
    transform: translateX(-50%); /* Centraliza horizontalmente */
    width: 80%; /* Largura do modal */
    max-width: 90%; /* Largura máxima */
    background-color: rgba(0, 0, 0, 0.7); /* Fundo semitransparente */
    justify-content: center; /* Centraliza o conteúdo no eixo horizontal */
    align-items: center; /* Centraliza o conteúdo no eixo vertical */
    z-index: 9999; /* Garante que o modal fique sobre outros elementos */
    padding: 20px;
    overflow: hidden;
}

/* Estilo do conteúdo dentro do modal */
#documentModal .modal-content {
    position: relative;
    display: flex;
    justify-content: center; /* Centraliza o conteúdo horizontalmente */
    align-items: center; /* Centraliza o conteúdo verticalmente */
    max-width: 90%; /* Limita a largura máxima */
    max-height: 80vh; /* Limita a altura do conteúdo */
    background: white; /* Cor de fundo branca */
    border-radius: 10px; /* Bordas arredondadas */
    padding: 20px;
    overflow: hidden;
}

/* Estilo do modal */
#documentModal {
    display: none; /* Inicialmente escondido */
    position: fixed;
    top: 10%; /* Faz o modal aparecer um pouco mais acima no centro da tela */
    left: 50%;
    transform: translateX(-50%); /* Centraliza horizontalmente */
    width: 80%; /* Largura do modal */
    max-width: 90%; /* Largura máxima */
    background-color: transparent; /* Removendo o fundo cinza */
    justify-content: center; /* Centraliza o conteúdo no eixo horizontal */
    align-items: center; /* Centraliza o conteúdo no eixo vertical */
    z-index: 9999; /* Garante que o modal fique sobre outros elementos */
    padding: 20px;
}

/* Estilo do conteúdo dentro do modal */
#documentModal .modal-content {
    position: relative;
    display: flex;
    justify-content: center; /* Centraliza o conteúdo horizontalmente */
    align-items: center; /* Centraliza o conteúdo verticalmente */
    max-width: 90%; /* Limita a largura máxima */
    max-height: 70vh; /* Limita a altura do conteúdo para não ultrapassar a altura da tela */
    background: white; /* Cor de fundo branca */
    border-radius: 10px; /* Bordas arredondadas */
    padding: 20px;
}

/* Estilo do botão de fechar (ícone X) */
#documentModal .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px; /* Tamanho maior para o ícone */
    color: #333;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: color 0.3s;
}

#documentModal .close:hover {
    color: #FFAF00; /* Cor quando o mouse passa sobre o ícone */
}

/* Estilo para a imagem ou conteúdo do documento */
#documentImage {
    width: 100%; /* Garante que a imagem ocupe toda a largura do modal */
    max-height: 70vh; /* Limita a altura da imagem para não ultrapassar 70% da altura da tela */
    object-fit: contain; /* Ajusta a imagem para caber dentro do espaço disponível */
    margin: auto; /* Garante que a imagem fique centralizada dentro do modal */
}



    </style>
</head>

<body>
    <div class="main-content">
        <h1 class="page-title">Documentos</h1>
        <div class="button-container">
            <button onclick="openModal()" class="btn-solicitar">Solicitar</button>
        </div>
        <a href="perfilAL.php" class="back-icon">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div id="modal" class="modal">
            <div class="modal-content">
                <span onclick="closeModal()" class="close">&times;</span>
                <h2>Selecione uma opção</h2>
                <form method="POST" action="../../controllers/upload_solicitacao.php">
                    <label class="custom-radio">
                        <input type="radio" name="tipo_documento" value="Avaliação Física" required>
                        <span class="radio-btn">
                            <i class="las la-check"></i>
                            <div class="hobbies-icon">
                                <h3>Avaliação Física</h3>
                            </div>
                        </span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="tipo_documento" value="Exames" required>
                        <span class="radio-btn">
                            <i class="las la-check"></i>
                            <div class="hobbies-icon">
                                <h3>Exames</h3>
                            </div>
                        </span>
                    </label>
                    <div class="button-container">
                        <button type="submit" class="btn-submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div id="popup-solicitacoes" class="popup">
            <div class="popup-content">
                <span id="popup-close-solicitacoes" class="popup-close">
                    <i class="fa-solid fa-times"></i>
                </span>
                <h2>Solicitações de Documentos</h2>
                <ul>
                    <?php
                    $stmt_solicitacoes = $conn->prepare("SELECT tipo_documento FROM solicitacoes WHERE fk_aluno_id_aluno = ?");
                    $stmt_solicitacoes->bind_param("i", $id_aluno);
                    $stmt_solicitacoes->execute();
                    $result_solicitacoes = $stmt_solicitacoes->get_result();

                    if ($result_solicitacoes->num_rows > 0) {
                        while ($row = $result_solicitacoes->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($row['tipo_documento']) . "</li>";
                        }
                    } else {
                        echo "<li>Nenhuma solicitação encontrada.</li>";
                    }

                    $stmt_solicitacoes->close();
                    ?>
                </ul>
                </div>
                </div>

                <!-- Documentos Respondidos -->
        <div class="documentos-respondidos">
            <h2>Documentos Respondidos</h2>
            <?php
            if ($result_documentos->num_rows > 0) {
                while ($documento = $result_documentos->fetch_assoc()) {
                    $tipo = htmlspecialchars($documento['tipo_documento']);
                    $arquivo = htmlspecialchars($documento['documento']);
                    $pasta = ($tipo == 'Avaliação Física') ? 'avaliacao' : 'documento';
                    $caminho_arquivo = "../../assets/uploads/alunos/$pasta/" . $arquivo;

                    echo "<div class='documento-item'>";
                    echo "<span>$tipo</span>";
                    echo "<i class='fa-solid fa-eye view-icon' onclick=\"openDocumentModal('$caminho_arquivo')\"></i>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum documento respondido encontrado.</p>";
            }
            ?>
        </div>



        <div id="documentModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeDocumentModal()">&times;</span>
                <img id="documentImage" src="" alt="Documento">
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        function openDocumentModal(caminho) {
            document.getElementById("documentImage").src = caminho;
            document.getElementById("documentModal").style.display = "flex";
        }

        function closeDocumentModal() {
            document.getElementById("documentModal").style.display = "none";
        }
        document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('popup-solicitacoes');
    const closePopup = document.getElementById('popup-close-solicitacoes');
    const viewIcons = document.querySelectorAll('.view-icon'); // Seleciona todos os ícones de visualização

    // Desabilitar os ícones de visualização enquanto o popup estiver visível
    function toggleViewIcons(disable) {
        viewIcons.forEach(icon => {
            icon.style.pointerEvents = disable ? 'none' : 'auto'; // Desabilita ou habilita os cliques
            icon.style.opacity = disable ? '0.5' : '1'; // Diminui a opacidade para indicar que está desabilitado
        });
    }

    // Exibe o popup automaticamente ao carregar
    popup.style.display = 'flex';
    toggleViewIcons(true); // Desabilita os ícones de visualização enquanto o popup está visível

    // Adiciona um evento de clique no botão de fechar
    closePopup.addEventListener('click', () => {
        popup.style.display = 'none';
        toggleViewIcons(false); // Reabilita os ícones de visualização quando o popup é fechado
    });
});

    </script>
</body>

</html>

<?php $conn->close(); ?>
