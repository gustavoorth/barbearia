<?php
$page = basename($_SERVER['PHP_SELF']);
if ($page == 'index.php'){
    echo
    '<nav class="navbar fixed-top navbar-expand-lg">
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
                <a class="nav-link" href="/elsalvador/agendar/agendar.php">Agendar</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/produtos/produtos.php">Produtos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="modal"
                data-target="#modal-perfil"
                href="#">Perfil</a>
            </li>

            <li class="nav-item nav-separador">
                <a class="nav-link" href="/elsalvador/carrinho.php">Carrinho</a>
            </li>';
            if(isset($_SESSION['user_id'])){echo '

                <li class="nav-item">
                <a class="nav-link" href="/elsalvador/perfil.php">Logado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/login/logout.php">Deslogar</a>
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
  } else {
  
echo '<nav class="navbar fixed-top navbar-expand-lg sticky-nav">
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
                <a class="nav-link" href="/elsalvador/agendar/agendar.php">Agendar</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/produtos/produtos.php">Produtos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/perfil.php">Perfil</a>
            </li>

            <li class="nav-item nav-separador">
                <a class="nav-link" href="/elsalvador/carrinho.php">Carrinho</a>
            </li>';
            if(isset($_SESSION['user_id'])){echo '

                <li class="nav-item">
                <a class="nav-link" href="/elsalvador/perfil.php">Logado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/elsalvador/login/logout.php">Deslogar</a>
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
  }
  
?>