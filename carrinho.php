<!doctype html>
<html>
    <head>
    
    <?php include_once('includes/head.php');         

    session_start(); 
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        ?>
    </head>
    
    <body>

    <?php include_once('includes/navbar.php');    
    ?>

<?php
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break;
    }
}
  	
}
?>


      <div class="container" style="padding-top: 130px;">
      <?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table table-image">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Produto</th>
              <th scope="col">Preço</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Preço</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
          <tbody>
            <tr>
              <td class="w-25">
                <img src='<?php echo $product["image"];?>' class="img-fluid img-thumbnail" alt="Sheep">
              </td>
              <td><?php echo $product["name"]; ?></td>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
			  <input type='hidden' name='action' value="remove" />
			  <td><?php echo "R$".$product["price"]; ?></td>
              <td class="qty">
				
			
			  <form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>

			</td>
              
              <td><?php echo "R$".$product["price"]*$product["quantity"]; ?></td>
              <td>
			  <form method='post' action=''>
			  	<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
			  	<input type='hidden' name='action' value="remove" />
			  <button type='submit' class='btn btn-danger btn-sm'><i class="fa fa-times"></i></button>
			 </form>
              </td>
              <?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
            </tr>
          </tbody>
        </table> 
        <div class="d-flex justify-content-end">
          <h5 style="padding-right: 20px;">Total: <span class="price text-success"><?php echo "R$".$total_price; ?></span></h5>
        <button type="button" class="btn btn-success" onclick="window.location=`checkout.php`;">Finalizar compra</button>
        <?php
}else{
	echo '<h3 class="text-center">O carrinho está vazio!</h3>
    </div>
    ';
    
	}
?>
      </div>
    </body>
</html>