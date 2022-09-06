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
        <ul class="navbar-nav ms-lg-5">;';
        if(isset($_SESSION['user_id'])){
        echo '

        <li class="nav-item">
        <a class="nav-link" href="/elsalvador/agendar/agendar.php">Agendar</a>
    </li>'; } else {
                echo '
                <li class="nav-item">
                <a class="nav-link" href="/elsalvador/login/login.php">Agendar</a>
            </li>
            ';
            }
            echo '
            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/produtos/produtos.php">Produtos</a>
            </li>

            <li class="nav-item">';
            if(isset($_SESSION['user_id'])){echo '
                <a class="nav-link" data-bs-toggle="modal"
                data-bs-target="#modal-perfil"
                href="#">Perfil</a>
            </li>
            <li class="nav-item nav-separador">
            <a class="nav-link" href="/elsalvador/carrinho.php">Carrinho</a>
        </li>
            
            ';} else {
                echo '
                <a class="nav-link"
                href="/elsalvador/login/login.php">Perfil</a>
            </li>
            <li class="nav-item nav-separador">
                <a class="nav-link" href="/elsalvador/login/login.php">Carrinho</a>
            </li>
                ';
            };
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
                Perfil | <a data-bs-toggle="modal"
                data-bs-target="#modal-agendamentos" href="#" > Agendamento </a>
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

<div class="modal fade" id="modal-agendamentos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title sb-txt-secondary sb-w-700">
                <a data-bs-toggle="modal"
                data-bs-target="#modal-perfil" href="#" > Perfil </a> | Agendamento
            </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true" class="sb-txt-white">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <?php 
                    $conn2 = mysqli_connect("localhost", "root", "", "barbearia_dev");

                    $queryAgendamento = "CALL PROC_AGENDAMENTOS_USUARIO('{$_SESSION["user_id"]}');";
                    $resultAgendamento = mysqli_query($conn2, $queryAgendamento);
                    $rowAgendamento = mysqli_num_rows($resultAgendamento);

                    if($rowAgendamento > 0){
                        while($dadosAgendamento = mysqli_fetch_array($resultAgendamento)){
                            if(strlen($dadosAgendamento["nome_barbearia"]) > 0){
                                $dataFormat = date("d/m/Y", strtotime($dadosAgendamento["data_agendamento"]));
                                $horarioFormat = substr($dadosAgendamento["horario_agendamento"], 0, 5);

                                echo "
                                    <div class='row'>
                                        <div class='col-sm-12 mt-1 mb-1'>
                                            <div class='card shadow-sm sb-bg-black'>
                                                <div class='card-body'>
                                                    <h5 class='sb-txt-secondary sb-w-700 mb-2'>
                                                        {$dadosAgendamento["nome_barbearia"]}
                                                    </h5>
                                                    <h6 class='sb-txt-white sb-w-500'>
                                                        <i class='fa fa-calendar'></i>
                                                        <span class='ml-1'>
                                                            Data: {$dataFormat}
                                                        </span>
                                                    </h6>
                                                    <h6 class='sb-txt-white sb-w-500'>
                                                        <i class='fa fa-clock-o'></i>
                                                        <span class='ml-1'>
                                                            Horário: {$horarioFormat}
                                                        </span>
                                                    </h6>
                                                    <h6 class='sb-txt-white sb-w-500'>
                                                        <i class='fa fa-cut'></i>
                                                        <span class='ml-1'>
                                                            Serviço: {$dadosAgendamento["nome_servico"]}
                                                        </span>
                                                    </h6>
                                                    <h6 class='sb-txt-white sb-w-500'>
                                                        <i class='fa fa-money'></i>
                                                        <span class='ml-1'>
                                                            Valor: R$ {$dadosAgendamento["valor_total"]}
                                                        </span>
                                                    </h6>
                                                    <h6 class='sb-w-500 sb-txt-white'>
                                                        <i class='fa fa-map-marker'></i>
                                                        <span class='ml-1'>
                                                            Endereço:
                                                            {$dadosAgendamento["rua"]} | 
                                                            Nº {$dadosAgendamento["num_bar"]} | 
                                                            {$dadosAgendamento["bairro"]}
                                                        </span>
                                                    </h6>
                                                    <h6 class='sb-txt-white sb-w-500'>
                                                        <i class='fa fa-phone'></i>
                                                        <span class='ml-1'>Telefone: 
                                                            {$dadosAgendamento["telefone"]}
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                ";  
                            }
                            else{
                                echo "
                                   <h5 class='sb-txt-white sb-w-500'>
                                        Não há agendamentos feitos
                                    </h5>
                                ";
                            }
                        }
                    }
                    else{
                        echo "
                           <h5 class='sb-txt-white sb-w-500'>
                                Não há agendamentos feitos
                            </h5>
                        ";
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary sb-w-700" data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>
