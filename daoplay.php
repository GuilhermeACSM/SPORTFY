<?php

// Garante que a sessão seja iniciada antes de verificar o login
session_start();
// Verifica se o usuário está logado
$logado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportfy - Da o Play</title>

    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" href="assets/Frame 1.png" type="image/x-icon">
</head>
<body>

    <!-- Navbar Responsiva -->
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

    <!-- Hero Section -->
    <section class="hero is-success is-medium">
        <div class="hero-body has-text-centered">
            <p class="title">Da o Play</p>
            <p class="subtitle">Encontre partidas e quadras disponíveis na sua região!</p>
            <div class="container has-text-centered">
                <a href="cadastro.php" class="button is-dark is-large">Cadastrar-se</a>
            </div>
        </div>
    </section>

    <!-- Seção de Busca -->
    <section class="section">
        <div class="container">
            <div class="box">
                <h2 class="title is-4">Busque por jogos ou quadras</h2>
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input class="input" type="text" placeholder="Digite o esporte ou local...">
                    </div>
                    <div class="control">
                        <button class="button is-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Partidas Disponíveis -->
    <section class="section">
        <div class="container">
            <h2 class="title is-4 has-text-centered">Partidas Disponíveis</h2>

            <div class="columns is-multiline">

                <!-- Card 1 -->
                <div class="column is-4">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-5">Futebol Society</p>
                            <p class="subtitle is-6">Local: Arena Santos</p>
                            <p><strong>Data:</strong> 15/02/2025 | <strong>Horário:</strong> 19h</p>
                            <button class="button is-success is-fullwidth mt-2">Participar</button>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="column is-4">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-5">Basquete 3x3</p>
                            <p class="subtitle is-6">Local: Ginásio Municipal</p>
                            <p><strong>Data:</strong> 18/02/2025 | <strong>Horário:</strong> 18h</p>
                            <button class="button is-success is-fullwidth mt-2">Participar</button>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="column is-4">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-5">Vôlei de Praia</p>
                            <p class="subtitle is-6">Local: Praia do Gonzaga</p>
                            <p><strong>Data:</strong> 20/02/2025 | <strong>Horário:</strong> 16h</p>
                            <button class="button is-success is-fullwidth mt-2">Participar</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container has-text-centered">
                <a href="perfil.php?Ajax=NovoJogo" class="button is-dark is-large">Criar Novo Jogo</a>
            </div>

        </div>
    </section>

    <!-- Rodapé -->
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
