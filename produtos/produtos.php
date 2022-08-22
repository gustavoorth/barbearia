<!doctype html>
<html>
    <head>
        
	<?php include_once('../includes/head.php');
	session_start(); 
    $_SESSION['url'] == $_SERVER['REQUEST_URI'];
        ?>
    </head>
    
    <body>
    <?php include_once('../includes/navbar.php'); ?>
    
    <section class="section-products">
		<div class="container">
				<div class="row justify-content-center text-center">
						<div class="col-md-8 col-lg-6">
								<div class="header">
										<h2>Produtos</h2>
										<p>Aqui você pode encontrar diversos produtos, complementando seu dia a dia e oferecendo diversas opções
											para seu cabelo e barba.
										</p>
								</div>
						</div>
				</div>
				<div class="row">
						<!-- Single Product -->
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-1" class="single-product">
										<div class="part-1">
												<ul>
														<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
												</ul>
										</div>
										<div class="part-2">
												<h3 class="product-title">Pente</h3>
												<h4 class="product-price">R$25</h4>
										</div>
								</div>
						</div>
						<!-- Single Product -->
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-2" class="single-product">
										<div class="part-1">
												<span class="discount">15% desconto</span>
												<ul>
														<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
												</ul>
										</div>
										<div class="part-2">
												<h3 class="product-title">Shampoo</h3>
												<h4 class="product-price">R$50</h4>
										</div>
								</div>
						</div>
						<!-- Single Product -->
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-3" class="single-product">
										<div class="part-1">
												<ul>
														<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
												</ul>
										</div>
										<div class="part-2">
												<h3 class="product-title">Condicionador</h3>
												<h4 class="product-old-price">R$60</h4>
												<h4 class="product-price">R$40</h4>
										</div>
								</div>
						</div>
						<!-- Single Product -->
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-4" class="single-product">
										<div class="part-1">
												<span class="new">new</span>
												<ul>
														<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
												</ul>
										</div>
										<div class="part-2">
												<h3 class="product-title">Gel</h3>
												<h4 class="product-price">R$15</h4>
										</div>
								</div>
						</div>
				</div>
		</div>
</section>
<?php include_once('../includes/footer.php'); ?>

</body>
</html>