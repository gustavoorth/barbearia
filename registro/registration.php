<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>BARBEARIA EL SALVADOR</title>
                
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/elsalvador.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    </head>
    
    <body>
    <?php include_once('navbar.php'); ?>

<section class="registro sb-bg-black sb-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 align-self-center mt-4 mb-4">
                <div class="card sb-card mb-3">
                    <div class="card-body">
                        <h4 class="sb-txt-white sb-text-md">
                            Crie sua conta 
                        </h4>

                        <form class="pt-3" id="form_registro" method="post">
                            <!-- campo de nome -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control sb-form-input" 
                                    id="registro_nome" 
                                    placeholder="Seu nome"
                                    name="nome"
                                >
                                <ion-icon name="person-outline" id="icone_nome">
                                </ion-icon>
                            </div>

                            <!-- campo de telefone -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control sb-form-input maskTelefone" 
                                    id="registro_telefone" 
                                    placeholder="Telefone"
                                    name="telefone"
                                >
                                <ion-icon name="call-outline" id="icone_telefone">
                                </ion-icon>
                            </div>

                            <!-- campo de email -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control sb-form-input" 
                                    id="registro_email" 
                                    placeholder="E-mail"
                                    name="email"
                                >
                                <ion-icon name="mail-outline" id="icone_email">
                                </ion-icon>
                            </div>

                            <!-- campo de senha -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="password" 
                                    class="form-control sb-form-input" 
                                    id="registro_senha" 
                                    placeholder="Sua senha"
                                    name="senha"
                                >
                                <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                            </div>

                            <!-- Confirmar de senha -->
                            <div class="form-group icone_dentro_input">
                                <!-- O atributo onkeyup juntamente com a expressão regular impede que o espaços sejam digitados neste campo -->
                                <input 
                                    type="password" 
                                    class="form-control sb-form-input" 
                                    id="registro_confirmar_senha" 
                                    placeholder="Confirme sua senha"
                                >
                                <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                            </div>

                            <button 
                                type="submit"
                                class="btn fa-btn sb-btn-secondary sb-w-700 sb-full-width mt-2"
                                name="cadastrar" 
                            >
                                Cadastrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 align-self-center" id="banner-registro">
                <img src="./assets/images/back-registro.jpg" alt="registro" id="img-registro">
            </div>
        </div>
    </div>
</section>


<?php
include_once('footer.php');
$conn = mysqli_connect("localhost","root","", "barbearia_dev");


if(isset($_POST['cadastrar'])){
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']); //mysqli_real_escape_string($conn, $_POST['nome']) evitar sql injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $email = strtolower($email); // DEIXA TDS OS CARACTERES MINUSCULO, POIS SE DEIXAR NORMAL VEI PODER TER "TESTE@EMAIL.COM" E "teste@email.com"
    $senha = md5(mysqli_real_escape_string($conn, $_POST['senha']));
    
    $queryEmail = "select email from user where email = '{$email}'";
    $resultEmail = mysqli_query($conn, $queryEmail);
    $rowEmail = mysqli_num_rows($resultEmail);
    //
    $queryTel = "select telefone from user where telefone = '{$telefone}'";
    $resultTel = mysqli_query($conn, $queryTel);
    $rowTel = mysqli_num_rows($resultTel);

    if ($rowTel ==1) {
        require_once "conteudo/registro/alert.php";
    }else{
        $insert = "INSERT INTO user (nome, telefone ,email, senha) VALUES ('$nome','$telefone', '$email', '$senha') ";

        $run_insert = mysqli_query($conn, $insert);
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>

        <script>
        
        Swal.fire({
          icon: 'success',
          title: 'Parabéns',
          text: 'Seu cadastro foi realizado com sucesso!'
        }).then(function() {
            window.location = 'login.php';
        });
        
        </script>";
    }
}


?>