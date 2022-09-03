<!doctype html>
<html>
    <head>
    

    
    <?php include_once('../includes/head.php');
    session_start(); 
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        ?>
    
    </head>
    
    <body>
    <?php include_once('../includesnavbar.php'); ?>
    <body>
    <?php  
        $conn = mysqli_connect("localhost","root","", "barbearia_dev");
        date_default_timezone_set('America/Sao_Paulo');

        $idUsuario = $_SESSION["user_id"];
        $idBarbearia = $_GET["id"];
        $data_agendamento = mysqli_real_escape_string($conn, $_POST['dia-agendamento']);
        $horario_agendamento = mysqli_real_escape_string($conn, $_POST['horario-agendamento']); 
        $pesquisaServico = "servico";
        $servicos = [];
        $valorTotal = 0;
        $horaAtual = date("H:i");
        $dataAtual = date("d-m");
        $date = new DateTime($data_agendamento);
        $horario_agendamentoConv = $date->format('d-m');

        foreach ($_POST as $key => $value){
            if (preg_match("/{$pesquisaServico}/", strval($key))){
                $id = substr($key, 8);
                array_push($servicos, $id);
            }
        }

        // fazer a soma do valor total dos serviços
        foreach ($servicos as $value){
            $queryServico = "select preco from servico where id_servico = '{$value}' and barbearia = '{$idBarbearia}'";
            $resultServico = $mysqli->query($queryServico);
            $servico = $resultServico->fetch_array();
            $valorTotal += $servico["preco"];
        }

        $queryNumAgendamentos = "select * from agendamento where data_agendamento = '{$data_agendamento}' and horario_agendamento = '{$horario_agendamento}' and barbearia = '{$idBarbearia}' and status = 'P'";
        $resultNumAgendamentos = $conn->query($queryNumAgendamentos);
        $numeroAgendamentos = $resultNumAgendamentos->num_rows;
        
        // Barrar marcação de serviços no mesmo dia com um horário que já passou
        if($dataAtual == $horario_agendamentoConv && $horaAtual > $horario_agendamento){
            echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'O horário selecionado não está mais disponível'
    })
</script>";   
        }
        else{
            // Horário não mais disponvível
            if($numeroAgendamentos > 0){
                echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'O horário selecionado não está mais disponível'
    }).then(function() {
        history.go(-1);
    })
</script>";
            }
            else{
                $queryQtdAgendamentos = "select count(*) as 'quantidade' from agendamento where usuario = '{$idUsuario}' and status = 'P' and barbearia = '{$idBarbearia}'";
                $resultQtdAgendamentos = $mysqli->query($queryQtdAgendamentos);
                $rowQtdAgendamentos = $resultQtdAgendamentos->fetch_assoc();
                $QtdAgendamentos = $rowQtdAgendamentos["quantidade"];

                // Número de agendamento excedidos
                if($QtdAgendamentos > 0){
                    include "conteudo/barbearia/msg/erro_qtd_agendamentos.php";
                }
                else{
                    // FAZ O AGENDAMENTO
                    $queryAgendamento = "CALL PROC_INS_AGENDAMENTO('{$idUsuario}', '{$idBarbearia}', '{$data_agendamento}', '{$horario_agendamento}', '{$valorTotal}')";
                    $resultAgendamento = $mysqli->query($queryAgendamento);
                    
                    $queryBuscarIdAgendamento = "select id_agendamento from agendamento where data_agendamento = '{$data_agendamento}' and horario_agendamento = '{$horario_agendamento}' and status = 'P'";
                    $resultIdAgendamento = $mysqli->query($queryBuscarIdAgendamento);
                    $rowAgendamento = $resultIdAgendamento->fetch_assoc();
                    $idAgendamento = $rowAgendamento["id_agendamento"];

                    foreach ($servicos as $value){
                        $queryAgendamentoServico = "CALL PROC_INS_AGENDAMENTO_SERVICO('{$idAgendamento}', '{$value}')";
                        $resultAgendamentoServico = $mysqli->query($queryAgendamentoServico);    
                    }

                    // Serviço marcado
                    if($mysqli->affected_rows > 0){
                        include "conteudo/barbearia/msg/sucesso.php";
                    }
                }
            }
        }

    ?>



    <?php include_once('../includes/footer.php');
     include "../functions.php";
    ?>
</body>
</html>