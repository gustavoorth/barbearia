<!doctype html>
<html>
    <head>
    <style> .banner{vertical-align: middle; width: 100%;
    height: auto;}</style>
	<?php include_once('../includes/head.php');
	session_start(); 
    $_SESSION['url'] == $_SERVER['REQUEST_URI'];
	?>
	</head>
	<body> <?php
	$con = mysqli_connect("localhost","root","","barbearia_dev");
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			die();
			}
	$status="";
	if (isset($_POST['code']) && $_POST['code']!=""){
	$code = $_POST['code'];
	$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$code = $row['code'];
	$price = $row['price'];
	$image = $row['image'];
	
	$cartArray = array(
		$code=>array(
		'name'=>$name,
		'code'=>$code,
		'price'=>$price,
		'quantity'=>1,
		'image'=>$image)
	);
	
	if(empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		print "<script>Swal.fire({
			icon: 'success',
			title: 'Parabéns',
			text: 'Produto adicionado no carrinho!'
		  }) </script>" ; 
	}else{
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($code,$array_keys)) {
			echo "<script>

			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Produto já está no carrinho.'
			  })

			</script>";	
		} else {
		$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
		echo "<script>
        
        Swal.fire({
          icon: 'success',
          title: 'Sucesso',
          text: 'Produto adicionado no carrinho!'
        })
        
        </script>";
		}
	
		}
	}
	include_once('../includes/navbar.php'); ?>

    <section class="section-products sb-bg-custom">
	<picture class="image" alt="Imagem sessao 1">
        <img class="banner"
            src="/elsalvador/assets/images/produtos.png" 
            alt="Agende seu serviço"
        />
    </picture>
		<div class="container">
				<div class="informacoes">
						<div class="col-md-8 col-lg-6">
								<div>
								<h3 class="sb-txt-secondary sb-w-700 mt-5">  
                                Produtos
                            </h3>
							<i class="fa-solid fa-bag-shopping"></i><p style="white-space: nowrap;">Aqui você pode encontrar diversos produtos, complementando seu dia a dia e oferecendo diversas opções para seu cabelo e barba.
										</p>
								</div>
						</div>
				</div>
				<div class="row">
				<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>

<?php
}

$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		echo '<div class="col-md-6 col-lg-4 col-xl-3">
		<div id="product-',$row["id"],'" class="single-product">
		<form method="post" action="">
		<input type="hidden" name="code" value="',$row["code"],'" />
				<div class="part-1">
						<ul>
								<li>
								<button style="background-color: white; border: 0px solid #E8E8E8;" type="submit">
								<i class="fas fa-shopping-cart"></i>
								</button>
								</form>
								</li>
						</ul>
				</div>
				<div class="part-2">
						<h3 class="product-title">',$row["name"],'</h3>
						<h4 class="product-price">R$',$row["price"],'</h4>
				</div>
			
		</div>
</div>';
        }
?>
				</div>
		</div>
</section>
<?php include_once('../includes/footer.php'); ?>

</body>
</html>