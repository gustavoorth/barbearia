<?php session_start();
include_once(__DIR__ . '..\..\backend\conecta.php');
if(isset($_POST['login']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $banco = new Banco;
    $conn = $banco->conectar();    
    
    $stmt = $conn->prepare('SELECT * FROM usuario WHERE email = :email AND senha = :senha');
    $stmt->execute([
        ':email' => $email,
        ':senha' => $password
        ]
    );    
    $ret = $stmt->fetch();
    
    if($ret){        
        $_SESSION['usuario_id']=$ret['usuario_id'];
        $_SESSION['uemail']=$ret['email'];
        echo "<script>window.location.href='perfil.php'</script>";
    }
    else{
        echo "<script>alert('Não foi encontrado usuário com o email e senha informados');</script>";
    }
  }
  ?>


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
    <body class="bg-registration-login">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">EL SALVADOR</h3></div>
                                    <h3 class="text-center font-weight-light my-4">Login do Usuário</h3>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="Email" required />
                                                <label for="inputEmail">Endereço de Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Senha" name="password" required />
                                                <label for="inputPassword">Senha</label>
                                            </div>
                                
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button  class="btn btn-primary"  type="submit" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="registration.php">Novo no site? Cadastre-se!</a></div>
                                        <hr />
                                           <div class="small"><a href="logout.php">Página Inicial</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
