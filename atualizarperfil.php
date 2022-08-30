
<body class="sb-bg-black">
    <?php
      include_once('includes/head.php');
        session_start(); 

        $conn = mysqli_connect("localhost","root","", "barbearia_dev");

        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $telefone = mysqli_real_escape_string($conn, $_POST['telefone']); 

        if(empty($_POST['nome']) || empty($_POST['telefone'])){
            
            echo "

            <script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Preencha todos os campos.'
            }).then(function() {
                window.location = 'index.php';
            });
          </script>";

        } else{
        
          $conn1 = mysqli_connect("localhost", "root", "", "barbearia_dev");

            $queryUsuarioLogado = "CALL PROC_SEL_USUARIO({$_SESSION['user_id']})";
            $resultUsuarioLogado = mysqli_query($conn1, $queryUsuarioLogado);
            $dadosUsuarioLogado = mysqli_fetch_assoc($resultUsuarioLogado);
            $queryTel = "select telefone from user where telefone = '{$telefone}'";
            $resultTel = mysqli_query($conn, $queryTel);
            $rowTel = mysqli_num_rows($resultTel);
        
            if ($rowTel == 1 and $dadosUsuarioLogado['telefone'] != $_POST['telefone']) {
                echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Telefone já cadastrado!'
        }).then(function() {
            window.location = 'index.php';
        });
        </script>";
            }else{

        $queryUsuario = "CALL PROC_UP_USER('{$_SESSION["user_id"]}', '{$nome}', '{$telefone}')";

        $conn->query($queryUsuario);
        $resultUsuario = $conn->affected_rows;
            
        if ($resultUsuario > 0) {
            echo "

            <script>
    Swal.fire({
        icon: 'success',
        title: 'Parabéns',
        text: 'Seu cadastro foi atualizado com sucesso!'
    }).then(function() {
        window.location = 'index.php';
    });
</script>
            
            
            ";
        }
        else{
            echo "

            <script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Houve um problema na atualização do seu cadastro, tente novamente mais tarde'
            }).then(function() {
                window.location = 'index.php';
            });
          </script>";
        }
    }
    }
    ?>
</body>