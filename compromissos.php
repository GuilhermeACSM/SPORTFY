<?php
require_once 'config.php';
require_once 'auth.php';


// Buscar os eventos (jogos) no banco de dados
/*$sql = "SELECT evento_nome, evento_data, evento_hora, evento_local, evento_esporte FROM eventos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Compromissos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <section id="section-comp" class="section">
        <div class="container">
            <h1 class="title has-text-centered">Meus Compromissos</h1>

            <!-- Lista de Eventos -->
            <div class="box">
                <?php if (count($eventos) > 0): ?>
                    <?php foreach ($eventos as $evento): ?>
                        <div class="card mb-4">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4"><?= htmlspecialchars($evento['evento_nome']) ?></p>
                                        <p class="subtitle is-6">
                                            <strong>Data:</strong> <?= htmlspecialchars($evento['evento_data']) ?> |
                                            <strong>Hora:</strong> <?= htmlspecialchars($evento['evento_hora']) ?> |
                                            <strong>Local:</strong> <?= htmlspecialchars($evento['evento_local']) ?> |
                                            <strong>Esporte:</strong> <?= htmlspecialchars($evento['evento_esporte']) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="has-text-centered">Nenhum compromisso encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>