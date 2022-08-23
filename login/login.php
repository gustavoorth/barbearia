<?php 
       if(!isset($_SESSION)) 
       { 
           session_start(); 
       } ?>

<!doctype html>
<html lang="pt-br">
  <head>

  <?php include_once('../includes/head.php'); ?>

  </head>
  <body>
    <div id="root">
    <?php


$conn = mysqli_connect("localhost","root","", "barbearia_dev");

if(isset($_POST['entrar'])){
    
    if(empty($_POST['email']) || empty($_POST['senha'])){
        echo "
        
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
        <script>

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos antes de prosseguir.'
                })

                </script>";
    }else{
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $query = " SELECT * FROM user WHERE email = '$email' and senha = '$senha' ";

        $result = mysqli_query($conn, $query);

        $dadosUsuario = mysqli_fetch_assoc($result);

        $row = mysqli_num_rows($result);

        if($row == 1){
            $_SESSION = $dadosUsuario;
            $url = '';
            if(isset($_SESSION['url'])){
                $url = $_SESSION['url'];
                 }else{ 
                $url = "index.php"; 
                 }
                 header("Location: ../$url"); 
                 exit();
        }else{
             echo "
             <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
             <script>

             Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Usuário ou senha inválidos.'
             })
             
             </script>";
            }
        }
    }
include_once('../includes/navbar.php');
?>
<section class="login sb-bg-black sb-content">
    <div class="container">
        <div class="row">
        <div class="col-md-6 col-sm-12 align-self-center" id="banner-login">
            <img src="/elsalvador/assets/images/back-login.jpg" alt="login" id="img-login">
        </div>
        <div class="col-md-5 col-sm-12 align-self-center mt-4 mb-4">
                <div class="card sb-card mb-3">
                    <div class="card-body">
                    <h4 class="sb-txt-white sb-text-md">
                            Faça login
                        </h4>
                        <form class="pt-3" id="form_login" method="post">
                            <!-- campo de email -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control sb-form-input" 
                                    id="login_email" 
                                    placeholder="E-mail"
                                    name="email"
                                >
                                <ion-icon name="mail-outline" id="icone_email">
                                </ion-icon>
                            </div>

                            <!-- campo de senha -->
                            <div class="form-group icone_dentro_input mt-2">
                                <input 
                                    type="password" 
                                    class="form-control sb-form-input" 
                                    id="login_senha" 
                                    placeholder="Sua senha"
                                    name="senha"
                                >
                                <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                            </div>
                            
                            <h6 class="sb-txt-white text-justify pt-2 pb-2">
                                <a href="#" class="sb-txt-secondary text-decoration-none">
                                    Esqueci minha senha 
                                </a> 
                            </h6>
                            <h6 class="sb-txt-white text-justify pt-2 pb-2">
                                Não tem uma conta?  
                                <a href="/elsalvador/registro/registro.php" class="sb-txt-secondary text-decoration-none" id="registre-se">
                                    Registre- se
                                </a>.
                            </h6>

                            <button 
                                type="submit"
                                class="btn fa-btn sb-btn-secondary sb-w-700 sb-full-width mt-2"
                                name="entrar" 
                            >
                                Entrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('../includes/footer.php');?>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>