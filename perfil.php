<?php
require_once 'config.php';
require_once 'auth.php';

// Verifica se está logado
//verificaLogin();

// Busca dados do usuário
$conn = conectar();
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!-- Substitua os dados estáticos pelos dados do usuário -->
<p class="title is-4 has-text-centered"><?php echo htmlspecialchars($usuario['nome']); ?></p>
<!-- Adicione o botão de logout -->
<button class="button is-danger is-fullwidth" onclick="window.location.href='logout.php'">Sair</button>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportfy</title>
    
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" href="assets/Frame 1.png" type="image/x-icon">
</head>
<body>

    <!-- Substitua os dados estáticos pelos dados do usuário -->
    <p class="title is-4 has-text-centered"><?php echo htmlspecialchars($usuario['nome']); ?></p>
    <!-- Adicione o botão de logout -->
    <button class="button is-danger is-fullwidth" onclick="window.location.href='logout.php'">Sair</button>

    <!-- Navbar Responsiva -->
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.html">
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
                <a class="navbar-item" href="daoplay.php">Da o Play</a>
                <a class="navbar-item" href="perfil.php">Perfil</a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <section class="section">
        <div class="container">
            <div class="columns">
                
                <!-- Sidebar do Perfil -->
                <aside class="column is-3">
                    <div class="card">
                        <div class="card-image has-text-centered">
                            <figure class="image is-128x128 is-inline-block">
                                <img src="img/usuario.png" alt="Imagem do perfil">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title is-4 has-text-centered">Nome do Usuário</p>
                            <p class="subtitle is-6 has-text-centered">Sexo | Idade</p>
                            
                            <div class="buttons is-centered">
                                <button class="button is-primary is-fullwidth">Meus Compromissos</button>
                                <button class="button is-link is-fullwidth">Criar Evento</button>
                                <button class="button is-warning is-fullwidth">Editar Perfil</button>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Conteúdo do Perfil -->
                <div class="column is-9">
                    <div class="box has-text-centered">
                        <h3 class="title is-4">Próximos Jogos</h3>
                        <a href="perfil_proximos_jogos.html" class="button is-success">Ver Jogos</a>
                    </div>

                    <!-- Mapa -->
                    <div class="box">
                        <h3 class="title is-4 has-text-centered">Localização</h3>
                        <iframe class="has-ratio" width="100%" height="400" src="https://www.google.com/maps/embed?..." allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
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
                navbarBurgers.forEach( el => {
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
