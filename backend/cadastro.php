<?php

include_once('conecta.php');
$dados = $_POST;
$banco = new Banco;
try{
    $conn = $banco->conectar();
} catch(PDOException $e){
    echo 'Falha ao salvar os arquivos. Favor, tente mais tarde.';
}

if($dados['senha'] == $dados['confirmpassword']){
        $query = $conn->prepare('SELECT * FROM usuario WHERE email = :email');
        $query->execute([
            ':email' => $dados['email']           
        ]);
        // Se houver um item com esse nome no banco, ele não insere
        if($query->fetch(PDO::FETCH_ASSOC) == null){
            $query = $conn->prepare('INSERT INTO usuario (nome, senha, email, administrador) VALUES (:nome, :senha, :email, :administrador);');
        $query->execute([
            ':nome' => $dados['nome'],
            ':senha' => $dados['senha'],
            ':email' => $dados['email'],
            ':administrador' => isset($dados['administrador']) ? $dados['administrador'] : null
        ]);
        header('location:..\frontend\index.html');
        
        } else{
            // Por enquanto só morre, depois mostrar de forma mais amigável para o usuário
            die('Já existe um usuário com o mesmo email cadastrado');
        }
    } else{
        die("<script>alert('As senhas nâo coincidem');</script>");
    }
    ?>