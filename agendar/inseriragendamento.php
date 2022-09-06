    <body class="sb-bg-custom">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <?php
        include_once('../includes/head.php');
        include "../functions.php";
        session_start(); 
        $conn = mysqli_connect("localhost","root","", "barbearia_dev");
        date_default_timezone_set('America/Sao_Paulo');

        $idUsuario = $_SESSION["user_id"];
        $idBarbearia = 8;
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
            $resultServico = $conn->query($queryServico);
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
    }).then(function() {
        history.go(-1);
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
                $resultQtdAgendamentos = $conn->query($queryQtdAgendamentos);
                $rowQtdAgendamentos = $resultQtdAgendamentos->fetch_assoc();
                $QtdAgendamentos = $rowQtdAgendamentos["quantidade"];

                // Número de agendamento excedidos
                if($QtdAgendamentos > 0){
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Você não pode agendar mais de um serviço'
                    }).then(function() {
                        history.go(-1);
                    })
                </script>";
                }
                else{
                    // FAZ O AGENDAMENTO
                    $queryAgendamento = "CALL PROC_INS_AGENDAMENTO('{$idUsuario}', '{$idBarbearia}', '{$data_agendamento}', '{$horario_agendamento}', '{$valorTotal}')";
                    $resultAgendamento = $conn->query($queryAgendamento);
                    
                    $queryBuscarIdAgendamento = "select id_agendamento from agendamento where data_agendamento = '{$data_agendamento}' and horario_agendamento = '{$horario_agendamento}' and status = 'P'";
                    $resultIdAgendamento = $conn->query($queryBuscarIdAgendamento);
                    $rowAgendamento = $resultIdAgendamento->fetch_assoc();
                    $idAgendamento = $rowAgendamento["id_agendamento"];

                    foreach ($servicos as $value){
                        $queryAgendamentoServico = "CALL PROC_INS_AGENDAMENTO_SERVICO('{$idAgendamento}', '{$value}')";
                        $resultAgendamentoServico = $conn->query($queryAgendamentoServico);    
                    }

                    // Serviço marcado
                    if($conn->affected_rows > 0){
                        echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Parabéns',
                            text: 'Serviço marcado com sucesso. No seu perfil, você pode conferir as informações.'
                        }).then(function() {
                            window.location = '/elsalvador/index.php';
                        });
                    </script>";
                    }
                }
            }
        }

    ?>
</body>
</html>