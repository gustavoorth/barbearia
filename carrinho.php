<!doctype html>
<html>
    <head>

    <?php include_once('includes/head.php');
    session_start(); 
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        ?>

  </head>
    
    <body>
    <?php include_once('includes/navbar.php'); ?>
<section class="h-100 h-custom" id="section_3">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="h5">Carrinho de compras</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  <div class="d-flex align-items-center">
                    <img src="https://http2.mlstatic.com/D_NQ_NP_604689-MLB41573808604_042020-O.jpg" class="img-fluid rounded-3"
                      style="width: 120px;" alt="Book">
                    <div class="flex-column ms-4">
                      <p class="mb-2">Pente</p>
                    </div>
                  </div>
                </th>
                <td class="align-middle">
                  <div class="d-flex flex-row">
                    <button class="btn btn-link px-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button>

                    <input id="form1" min="0" name="quantity" value="2" type="number"
                      class="form-control form-control-sm" style="width: 50px;" />

                    <button class="btn btn-link px-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button> 
                  </div>
                </td>
                <td class="align-middle">
                  <p class="mb-0" style="font-weight: 500;">R$25</p>
                </td>
              </tr>
              <tr>
                <th scope="row" class="border-bottom-0">
                  <div class="d-flex align-items-center">
                    <img src="https://blog.beard.com.br/wp-content/uploads/2017/05/shampoo-barba-escura-6-800x800.jpg" class="img-fluid rounded-3"
                      style="width: 120px;" alt="Book">
                    <div class="flex-column ms-4">
                      <p class="mb-2">Shampoo</p>
                    </div>
                  </div>
                </th>
                <td class="align-middle border-bottom-0">
                  <div class="d-flex flex-row">
                    <button class="btn btn-link px-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button>

                    <input id="form1" min="0" name="quantity" value="1" type="number"
                      class="form-control form-control-sm" style="width: 50px;" />

                    <button class="btn btn-link px-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </td>
                <td class="align-middle border-bottom-0">
                  <p class="mb-0" style="font-weight: 500;">R$50</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
          <div class="card-body p-4">

            <div class="row">
              <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
              <div class="col-lg-4 col-xl-3">

                <hr class="my-4">

                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                  <p class="mb-2">Valor total: R$75</p>
                </div>

                <button type="button" class="btn btn-primary btn-block btn-lg">
                  <div class="d-flex justify-content-between">
                    <span>Finalizar</span>
                  </div>
                </button>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<?php include_once('includes/footer.php'); ?>
</body>
</html>