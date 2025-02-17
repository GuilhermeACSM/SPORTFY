<?php
require_once 'config.php';
require_once 'auth.php';
verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <section id="section-edit" class="section">
        <div class="container">
            <div class="box">
                <h3 class="title is-4 has-text-centered">Editar Perfil</h3>

                <!-- Formulário de Edição de Perfil -->
                <form method="POST" action="atualizar_perfil.php" enctype="multipart/form-data">
                    <!-- Campo Nome -->
                    <div class="field">
                        <label class="label">Nome</label>
                        <div class="control">
                            <input class="input" type="text" name="nome" placeholder="Digite seu nome" required>
                        </div>
                    </div>

                    <!-- Campo Foto -->
                    <div class="field">
                        <label class="label">Foto de Perfil</label>
                        <div class="file">
                            <label class="file-label">
                                <input class="file-input" type="file" name="foto" accept="image/*">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Escolher arquivo…
                                    </span>
                                </span>
                            </label>
                        </div>
                        <p class="help">Formatos suportados: JPG, PNG, GIF.</p>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="field is-grouped is-grouped-centered">
                        <div class="control">
                            <button class="button is-success" type="submit">Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Ícones do Font Awesome (opcional) -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>