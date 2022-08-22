<!doctype html>
<html>
    <head>
      
    <?php include_once('../includes/head.php');?>
    </head>
    
    <body>
    <?php include_once('../includes/navbar.php'); ?>

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

                            <div class="form-group icone_dentro_input">
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
            <div class="col-md-6 col-sm-12 align-self-center" id="banner-registro">
                <img src="/elsalvador/assets/images/back-registro.jpg" alt="registro" id="img-registro">
            </div>
        </div>
    </div>
</section>


<?php
include_once('../includes/footer.php');
$conn = mysqli_connect("localhost","root","", "barbearia_dev");


if(isset($_POST['cadastrar'])){
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $email = strtolower($email);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    
    $queryEmail = "select email from user where email = '{$email}'";
    $resultEmail = mysqli_query($conn, $queryEmail);
    $rowEmail = mysqli_num_rows($resultEmail);

    $queryTel = "select telefone from user where telefone = '{$telefone}'";
    $resultTel = mysqli_query($conn, $queryTel);
    $rowTel = mysqli_num_rows($resultTel);

    if ($rowTel == 1 || $rowEmail == 1) {
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
            window.location = '../login/login.php';
        });
        
        </script>";
    }
}


?>
    </body>
</html>