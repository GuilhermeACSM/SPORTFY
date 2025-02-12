<?php
// auth.php

// Inicia a sessão em todas as páginas que incluírem este arquivo
session_start();

// Função para verificar se o usuário está logado
function verificaLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }
}

// Função para fazer login
function fazerLogin($email, $senha) {
    $conn = conectar(); // Função definida no config.php
    
    try {
        // Busca o usuário pelo email
        $stmt = $conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica se encontrou o usuário e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Guarda as informações do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            return true;
        }
        return false;
    } catch(PDOException $e) {
        error_log("Erro no login: " . $e->getMessage());
        return false;
    }
}

// Função para fazer logout
function fazerLogout() {
    // Destrói todas as variáveis de sessão
    $_SESSION = array();
    
    // Destrói a sessão
    session_destroy();
    
    // Redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Função para verificar se o usuário já está logado
function estaLogado() {
    return isset($_SESSION['usuario_id']);
}

// Função para obter dados do usuário logado
function getUsuarioLogado() {
    if (!estaLogado()) {
        return null;
    }
    
    $conn = conectar();
    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$_SESSION['usuario_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erro ao buscar usuário: " . $e->getMessage());
        return null;
    }
}

// Função para atualizar dados do usuário
function atualizarUsuario($dados) {
    if (!estaLogado()) {
        return false;
    }
    
    $conn = conectar();
    try {
        $sql = "UPDATE usuarios SET 
                nome = ?, 
                telefone = ?, 
                cidade = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cidade'],
            $_SESSION['usuario_id']
        ]);
        
        return true;
    } catch(PDOException $e) {
        error_log("Erro ao atualizar usuário: " . $e->getMessage());
        return false;
    }
}

// Função para alterar a senha
function alterarSenha($senha_atual, $nova_senha) {
    if (!estaLogado()) {
        return false;
    }
    
    $conn = conectar();
    try {
        // Primeiro verifica se a senha atual está correta
        $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE id = ?");
        $stmt->execute([$_SESSION['usuario_id']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!password_verify($senha_atual, $usuario['senha'])) {
            return false;
        }
        
        // Atualiza para a nova senha
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->execute([$nova_senha_hash, $_SESSION['usuario_id']]);
        
        return true;
    } catch(PDOException $e) {
        error_log("Erro ao alterar senha: " . $e->getMessage());
        return false;
    }
}

// Função para registrar um novo usuário
function registrarUsuario($dados) {
    $conn = conectar();
    try {
        // Verifica se o email já existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$dados['email']]);
        if ($stmt->fetch()) {
            return "Email já cadastrado";
        }
        
        // Cria o hash da senha
        $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        
        // Insere o novo usuário
        $sql = "INSERT INTO usuarios (nome, email, senha, sexo, data_nascimento, cidade, telefone) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $dados['nome'],
            $dados['email'],
            $senha_hash,
            $dados['sexo'],
            $dados['nascimento'],
            $dados['cidade'],
            $dados['telefone']
        ]);
        
        return true;
    } catch(PDOException $e) {
        error_log("Erro no registro: " . $e->getMessage());
        return "Erro ao registrar usuário";
    }
}
?>