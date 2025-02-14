<?php
require_once 'config.php';
require_once 'auth.php';


// Verifica se o usuário está logado
$logado = isset($_SESSION['usuario_id']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['nascimento'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    
    $conn = conectar();
    
    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, sexo, data_nascimento, cidade, telefone) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senha, $sexo, $data_nascimento, $cidade, $telefone]);
        
        header("Location: login.php?cadastro=sucesso");
        exit;
    } catch(PDOException $e) {
        $erro = "Erro no cadastro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/Frame 1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="shortcut icon" href="assets/Frame 1.png" type="image/x-icon">
    <title>Cadastro - Sportfy</title>
</head>

<body>
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <img src="assets/Logo.png" alt="Logo Sportify">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="index.php">Home</a>
                <?php if ($logado): ?>
                    <a class="navbar-item" href="daoplay.php">Da o Play</a>
                    <a class="navbar-item" href="perfil.php">Perfil</a>
                    <a class="navbar-item" href="logout.php">Sair</a>
                <?php else: ?>
                    <a class="navbar-item" href="daoplay.php">Da o Play</a>
                    <a class="navbar-item" href="login.php">Entrar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container">
            <div class="box">
                <h1 class="title has-text-centered">Cadastro do Atleta</h1>
                <form action="" method="post" id="form">
                    <div class="field">
                        <label class="label">Nome</label>
                        <div class="control">
                            <input class="input" type="text" name="nome" placeholder="Nome Completo" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Sexo</label>
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="sexo" value="masculino" checked> Masculino
                            </label>
                            <label class="radio">
                                <input type="radio" name="sexo" value="feminino"> Feminino
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Data de Nascimento</label>
                        <div class="control">
                            <input class="input" type="date" name="nascimento" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Cidade</label>
                        <div class="control">
                            <input class="input" type="text" name="cidade" placeholder="Cidade" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Telefone</label>
                        <div class="control">
                            <input class="input" type="tel" name="telefone" placeholder="(xx)xxxx-xxxx" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Senha</label>
                        <div class="control">
                            <input class="input" type="password" name="senha" placeholder="Senha" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-primary is-fullwidth" type="submit">Cadastrar</button>
                        </div>
                    </div>
                    <div class="has-text-centered">
                        <p>Já tem uma conta? <a href="login.html">Entrar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer has-background-dark has-text-white">
        <div class="content has-text-centered">
            <p>&copy; 2024 - Criado por DFG</p>
            <div class="social">
                <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>
    <script>
        // Script para ativar o menu hamburguer
        document.addEventListener('DOMContentLoaded', () => {
            const navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            if (navbarBurgers.length > 0) {
                navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });
    </script>
</body>

</html>
