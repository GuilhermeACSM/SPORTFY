<?php
// auth.php
session_start();

function verificaLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }
}

function fazerLogin($email, $senha) {
    $conn = conectar();
    
    try {
        $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            return true;
        }
        return false;
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

function fazerLogout() {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>