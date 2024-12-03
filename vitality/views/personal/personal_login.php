<?php
session_start();
include '../../db/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/personal.css" />
    <link rel="icon" href="../../assets/img/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="img/favicon.png" type="image/png"> 
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Vitality - Se junte a nós</title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form class="sign-in-form" method="POST" action="loginPS.php">
                    <h2 class="title">Entrar</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="E-mail" id="email" name="email" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha" id="senha" name="senha" required/>
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                    <div class="forgot-password">
                        <a href="../shared/senha.php">Esqueci minha senha</a>
                    </div>
                </form>

                <form class="sign-up-form" method="POST" action="cadastro_personal.php">
                    <h2 class="title">Faça o cadastro</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nome Completo" id="nome" name="nome" required />
                    </div>
                    <div class="input-field">
                    <i class="fas fa-check-square"></i>
                        <input type="text" placeholder="CREF" id="cref" name="cref" required maxlength="11"/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" id="email" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha" id="senha" name="senha" required />
                    </div>
                    <input type="submit" class="btn" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="back-button">
                    <button class="btn transparent" onclick="window.location.href='../shared/escolha.php'">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                </div>
                <div class="content">
                    <h3>Novo por aqui?</h3>
                    <p>Seja bem-vindo(a) ao Vitality!</p>
                    <button class="btn transparent" id="sign-up-btn">
                        Cadastrar-se
                    </button>
                </div>
                <img src="img/" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Um de nós?</h3>
                    <p>Que bom ter você de volta!</p>
                    <button class="btn transparent" id="sign-in-btn">
                        Faça login
                    </button>
                </div>
                <div class="back-button">
                    <button class="btn transparent" onclick="window.location.href='../shared/escolha.php'">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                </div>
                <img src="img" class="image" alt="" />
            </div>
        </div>
    </div>
    <script src="../../assets/js/personal.js"></script>
</body>
</html>
<!-- oninput="mascaraCREF(this)" -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const crefInput = document.getElementById('cref');

    crefInput.addEventListener('input', function (event) {
        let value = this.value;

        value = value.replace(/[^a-zA-Z0-9]/g, '');

        if (value.length > 6 && value.indexOf('-') === -1) {
            value = value.slice(0, 6) + '-' + value.slice(6);
        }

        if (value.length > 8 && value.indexOf('/') === -1) {
            value = value.slice(0, 8) + '/' + value.slice(8);
        }

        if (event.inputType === 'deleteContentBackward') {
            value = value.replace(/[-\/]$/, '');
        }

        this.value = value.toUpperCase().slice(0, 11);
    });

    const signInBtn = document.getElementById('sign-in-btn');
    const signUpBtn = document.getElementById('sign-up-btn');
    const container = document.querySelector('.container');

    signInBtn.addEventListener('click', () => {
        container.classList.remove('sign-up-mode');
    });

    signUpBtn.addEventListener('click', () => {
        container.classList.add('sign-up-mode');
    });
});

</script>
