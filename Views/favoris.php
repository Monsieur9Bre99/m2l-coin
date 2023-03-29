<?php if(isset($_SESSION["idU"])  && ($_SESSION["idU"] != NULL)) { ?>
 <!-- Property List Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-12">
                        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                            <h1 class="mb-3">Mes favoris</h1>
                            <p>Vous consultez les favoris en ligne</p>
                        </div>
                    </div>
                    <div class="col-lg-12 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <!--<li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <?php foreach($GLOBALS['MESFAVORIS'] as $fav){ ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="<?php echo sprintf("%smodifier-annonce/%s", $GLOBALS['__HOST__'], $fav['idAnnonce'])?>"><img class="img-fluid" src="img/property-1.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Annonce</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3"><?php if($fav['idCategorie'] == 3){echo sprintf("à partir de %s € / nuit", $fav['prix']);}else{echo sprintf("%s €", $fav['prix']);} ?></h5>
                                        <a class="d-block h5 mb-2" href="#"><?php echo sprintf("%s", $fav['titre']); ?></a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo sprintf("%s", $fav['dep']); ?></p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar text-primary me-2"></i><?php echo sprintf("Ajouté en favori le %s", date_format(date_create($fav['DateAjout']), "d/m/Y à H:i")); ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property List End -->

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <?php 
        }
        else 
        {
            $_SESSION["message"] = "Veuillez vous connecter pour accéder à votre compte.";
            $_SESSION["status"] = "dark";
            $_SESSION["icone"] = "fa-check-circle"; ?>
            <script>window.location.replace("http://127.0.0.1/projetLeboncoin/connexion")</script>
        <?php } 
    ?>