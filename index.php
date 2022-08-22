<!doctype html>
<html>
    <head>
    
    <?php include_once('includes/head.php');         

    session_start(); 
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        ?>
    </head>
    
    <body>

    <?php include_once('includes/navbar.php')?>

        <main>

            <section class="hero d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12">
                            <div class="heroText">
                                <h1 class="text-white mb-lg-5 mb-4">EL SALVADOR</h1>
                                <h2 class="text-white mb-lg-5 mb-4">BARBEARIA</h1>

                                
                            </div>
                        </div>

                    </div>
                </div>

                <div class="overlay"></div>
            </section>

            <section class="about section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <h2 class="mb-5">Barbearia EL SALVADOR</h2>
                        </div>

                        <div class="col-lg-4 col-12 ms-lg-auto mb-5 mb-lg-0">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-intro-tab" data-bs-toggle="tab" data-bs-target="#nav-intro" type="button" role="tab" aria-controls="nav-intro" aria-selected="true">Sobre</button>

                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Barbeiros</button>
                                </div>
                            </nav>
                        </div>

                        <div class="col-12">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-intro" role="tabpanel" aria-labelledby="nav-intro-tab">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-lg-0 mb-4">
                                            <img src="/elsalvador/images/frente-barbearia.jpg" class="img-fluid" alt="">
                                        </div>

                                        <div class="col-lg-5 col-12 m-auto">
                                            <h3 class="mb-3">Sobre a barbearia</h3>

                                            <p>A nossa barbearia busca te atender da melhor forma, buscando serviços eficientes e impecáveis.</p>

                                            <p>A barbearia encontra se no endereço: Rua euclides, n.º 621, Salvador do Sul.</p>
                                            
                                            <p>Todas as imagens utilizadas no site são ilustrativas, os créditos são da <a rel="nofollow" href="https://freepik.com/" target="_blank">FreePik.com</a> Obrigado por disponibilizar essas imagens de graça.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        <div class="col-lg-5 col-12 m-auto">
                                            <h3 class="mb-3">Francisco Germano</h3>

                                            <p>O mais experiente, sendo ágil e preciso. Formou-se no Instituto dos Barbeiros Gaúchos e atualmente cursa a faculdade dos penteados modernos.</p>

                                            <h3 class="mb-3">Carla Figueiredo</h3>

                                            <p>A jovem, que busca aprendizado sem deixar de lado a sua rapidamente conquistada maestria e precisão. Estuda no Instituto dos Barbeiros Gaúchos.</p>


                                        </div>

                                        <div class="col-lg-6 col-12 mt-lg-0 mt-4">
                                            <img src="/elsalvador/images/barbeiros.jpg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="pricing section-padding" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <h2 style="color: #000;" class="text-whte mb-5 text-center">Horários de atendimento</h2>
                        </div>
                        <div class="col-lg-6 col-12 mt-lg-0 mt-5">
                            <div class="pricing-plan border-0 bg-white shadow-lg">

                                    <div class="pricing-name" style="text-align: center">
                                        <h4>Segunda a sexta</h4>
                                    </div>
                                    
                                <div class="pricing-body">
                                    <h5 class="mb-3">Horários</h5>

                                        <h6 class="mb-3">Manhã</h6>
                                        <p class="pricing-list-item">7:30 as 11:30</p>
                                        <h6 class="mb-3">Tarde</h6>
                                        <p class="pricing-list-item">13:30 as 17:30</p>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 mt-lg-0 mt-5">
                            <div class="pricing-plan border-0 bg-white shadow-lg">

                                    <div class="pricing-name" style="text-align: center">
                                        <h4>Sábado</h4>
                                    </div>
                                    
                                <div class="pricing-body">
                                    <h5 class="mb-3">Horários</h5>

                                        <h6 class="mb-3">Manhã</h6>
                                        <p class="pricing-list-item">8:30 as 11:30</p>
                                        <h6 class="mb-3">Tarde</h6>
                                        <p class="pricing-list-item">13:30 as 16:30</p>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="overlay dark-overlay"></div>
            </section>
            <?php include_once('includes/footer.php'); ?>
            <script src="/elsalvador/js/custom.js"></script>
        </main>
    </body>
</html>
