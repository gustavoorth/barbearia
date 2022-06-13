<!DOCTYPE html>
<html lang="pt-br">

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
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">EL SALVADOR</h3>
                                </div>
                                <h3 class="text-center font-weight-light my-4">Cadastro de Usuário</h3>
                                <div class="card-body">
                                    <form method="post" name="registration" action="../backend/cadastro.php">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="nome" type="text" name="nome"
                                                placeholder="Insira Nome" required />
                                            <label for="nome">Nome</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email"
                                                placeholder="nome@exemplo.com" />
                                            <label for="inputEmail">Endereço de Email</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" type="password"
                                                        placeholder="Crie uma Senha" name="senha" id="senha" />
                                                    <label for="senha">Senha</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm"
                                                        type="password" placeholder="Confirme a Senha"
                                                        name="confirmpassword" id="confirmpassword" />
                                                    <label for="inputPasswordConfirm">Confirmar a Senha</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        session_start();
                                        $sessao = isset($_SESSION['usuario_id']);
                                        if($sessao == false)
                                        {
                                        }else{
                                        if($_SESSION['administrador'] == 1){
                                        include_once(__DIR__ . '..\..\backend\conecta.php');
                                        $banco = new Banco;
                            $conn = $banco->conectar();
                            if($banco->autentica($_SESSION["usuario_id"])){
        
                                echo ('
                                         <div class="form-floating mb-3">
                                         <input class="form-control" id="inputadministrador" type="number" name="administrador"
                                             placeholder="1,2,3" />
                                         <label for="inputcrn">Administrador</label>
                                     </div>
                                         ');
                                            }}}
                                            ?>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" name="submit" class="btn btn-primary btn-block">Criar Conta</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                <?php
                                        if($sessao == false)
                                        { echo '<div class="small"><a href="login.php">Já possui uma conta? Faça o Login</a></div><hr />';
                                        }
                                ?>    
              
                                    <div class="small"><a href="logout.php">Página Inicial</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>