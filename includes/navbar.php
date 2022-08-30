<?php
$page = basename($_SERVER['PHP_SELF']);
if ($page == 'index.php'){
    echo
    '<nav class="navbar fixed-top navbar-expand-lg">';}
    else {
        echo '<nav class="navbar fixed-top navbar-expand-lg sticky-nav">';}
        echo '
        <div class="container">

    <a href="/elsalvador/index.php" class="navbar-brand">
        EL SALVADOR
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-lg-5">

            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/agendar/agendar.php?id=8">Agendar</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/produtos/produtos.php">Produtos</a>
            </li>

            <li class="nav-item">';
            if(isset($_SESSION['user_id'])){echo '
                <a class="nav-link" data-bs-toggle="modal"
                data-bs-target="#modal-perfil"
                href="#">Perfil</a>
            </li>';} else {
                echo '
                <a class="nav-link"
                href="/elsalvador/login/login.php">Perfil</a>
            </li>
                ';
            };
            echo '
            <li class="nav-item nav-separador">
                <a class="nav-link" href="/elsalvador/carrinho.php">Carrinho</a>
            </li>';
            if(isset($_SESSION['user_id'])){
                $conn1 = mysqli_connect("localhost", "root", "", "barbearia_dev");
                $queryUsuarioLogado = "CALL PROC_SEL_USUARIO({$_SESSION['user_id']})";
                $resultUsuarioLogado = mysqli_query($conn1, $queryUsuarioLogado);
                $dadosUsuarioLogado = mysqli_fetch_assoc($resultUsuarioLogado);
                echo '
                <li class="nav-item">
                <a class="nav-link" href="/elsalvador/login/logout.php">Deslogar</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal"
                data-bs-target="#modal-perfil"
                href="#"">',ucwords($dadosUsuarioLogado['nome']),'</a>
            </li>
        </ul>

    </div>
</div>
</nav>';
            } else { echo'
                <li class="nav-item nav-registro">
                <a class="nav-link" href="/elsalvador/registro/registro.php">Registro</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/login/login.php">Login</a>
                </li>
            </ul>

            </div>
        </div>
        </nav>';
            }

//MODAL//

echo '<div class="modal fade" id="modal-perfil" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title sb-txt-secondary sb-w-700">
                Perfil
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true" class="sb-txt-white">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-perfil" method="POST" action="/elsalvador/atualizarperfil.php">';
        
            if(isset($_SESSION['user_id'])){
                $conn1 = mysqli_connect("localhost", "root", "", "barbearia_dev");

                $queryUsuarioLogado = "CALL PROC_SEL_USUARIO({$_SESSION['user_id']})";

                $resultUsuarioLogado = mysqli_query($conn1, $queryUsuarioLogado);

                $dadosUsuarioLogado = mysqli_fetch_assoc($resultUsuarioLogado);

                echo "
                    <!-- Nome -->
                    <div class='form-group row'>
                        <label for='inputPassword' class='col-sm-4 col-form-label sb-txt-white'>
                            Nome:
                        </label>
                        <div class='col-sm-8'>
                            <input 
                                type='text' 
                                class='form-control-plaintext sb-form-input pl-2 cursor-na' 
                                value='{$dadosUsuarioLogado['nome']}'
                                name='nome'
                                id='input-nome'
                                readonly
                            >
                        </div>
                    </div>

                    <!-- Telefone -->
                    <div class='form-group row'>
                        <label for='inputPassword' class='col-sm-4 col-form-label sb-txt-white'>
                            Telefone:
                        </label>
                        <div class='col-sm-8'>
                            <input 
                                type='text' 
                                class='form-control-plaintext sb-form-input pl-2 maskTelefone cursor-na' 
                                value='{$dadosUsuarioLogado['telefone']}'
                                name='telefone'
                                id='input-telefone'
                                readonly
                            >
                        </div>
                    </div>

                ";}
                echo '<div class="btn-salvar">
                <button class="btn sb-btn-secondary sb-w-700 d-none" id="salvar">Salvar Alterações</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary sb-w-700" data-bs-dismiss="modal">
            Fechar
        </button>
        <button 
            class="btn sb-btn-secondary sb-w-700"
            id="editar"
        >
            Editar
        </button>
    </div>
</div>
</div>
</div>';

?>