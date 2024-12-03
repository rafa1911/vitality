<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$banco = "vitality";
$conn = new mysqli($host, $user, $pass, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$id_personal = $_SESSION['usuario_id']; 
$sql_personal = "SELECT foto_perfil_personal FROM personal WHERE id_personal = ?";
  $stmt_personal = $conn->prepare($sql_personal);
  $stmt_personal->bind_param("i", $id_personal);
  $stmt_personal->execute();
  $result_personal = $stmt_personal->get_result();

  if ($result_personal->num_rows > 0) {
    $row_personal = $result_personal->fetch_assoc();
    $foto_perfil_personal = $row_personal['foto_perfil_personal'] ? $row_personal['foto_perfil_personal'] : '../../assets/img/Profile-PNG-File.png';
  }

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="../../assets/css/editar_foto.css">
    <link rel="icon" href="../../assets/img/favicon.svg" type="image/svg+xml">
    <title>Editar Foto de Perfil - Personal Trainer</title>
</head>
<style>
        #foto_perfil {
            display: none;
        }

        /* Estilo do botão personalizado */
        .custom-upload-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #F5004F;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-upload-button:hover {
            background-color: #ff4081;
        }

        #file-chosen {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .preview img {
            max-width: 150px;
            margin-top: 15px;
        }
</style>
<body>

    <div class="container">
        <a href="perfil_personal.php" class="back-icon">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1>Editar Foto de Perfil</h1>
        <div class="foto-atual">
            <h3>Foto Atual:</h3>
            <img src="../../assets/uploads/personais/<?php echo empty($foto_perfil_personal) && file_exists('../../assets/uploads/personais/'. $foto_perfil_personal) ? htmlspecialchars( $foto_perfil_personal) : 'Profile-PNG-File.png' ?>"  class="foto-perfil" alt="foto do usuario"/>
        </div>

        <form action="upload_personal.php" method="POST" enctype="multipart/form-data">
            <label for="foto_perfil">Escolha uma nova foto de perfil:</label>
            <button type="button" class="custom-upload-button" onclick="document.getElementById('foto_perfil').click()">Escolher Arquivo</button>
            <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" onchange="previewImage(event)">
            <p id="file-chosen">Nenhum arquivo escolhido</p>
            <div class="preview">
                <img id="preview" alt="Preview da nova foto" style="display: none;">
            </div>
            <button type="submit" name="atualizar_foto">Atualizar Foto</button>
        </form>

        <form action="upload_personal.php" method="POST">
            <input type="hidden" name="remover_foto" value="1">
            <button type="submit" name="remover_foto_btn">Remover Foto</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const fileName = event.target.files[0] ? event.target.files[0].name : "Nenhum arquivo escolhido";
            document.getElementById('file-chosen').textContent = fileName;

            const preview = document.getElementById('preview');
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; 
                }
                reader.readAsDataURL(event.target.files[0]);
            } else {
                preview.style.display = 'none'; 
            }
        }
    </script>
</body>
</html>