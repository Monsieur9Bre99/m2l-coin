
        <!-- Header Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <?php if((isset($_SESSION) && ($_SESSION != NULL))){ ?>
                    <div class="d-flex justify-content-center">
                        <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-7  alert alert-<?= $_SESSION["status"] ?> text-center" role="alert">
                            <i class="fa <?=$_SESSION["icone"]  ?> fa-2x me-3" aria-hidden="true"></i>
                            <strong><?= $_SESSION["message"]?></strong> 
                        </div>
                    </div>
                    
                <?php unset($_SESSION["icone"]); unset($_SESSION["status"]); unset($_SESSION["message"]); }?>
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h1 class="mb-2">Des millions de petites annonces et autant d’occasions de se faire plaisir !!</h1>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <form action="<?php echo $GLOBALS['__HOST__']?>search" method="POST">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="category" class="form-select border-0 py-3">
                                    <option selected>Catégories</option>
                                    <?php foreach($GLOBALS["categories"] as $category){ ?>
                                    <option value="<?php echo $category['idCategorie'];?>"><?php echo sprintf("%s", $category['libelle']);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="what" class="form-control border-0 py-3" placeholder="Que recherchez-vous ?">
                            </div>
                            <div class="col-md-4">
                                <select name="location" class="form-select border-0 py-3">
                                    <option selected>Choisissez la localisation</option>
                                    <?php foreach($GLOBALS["locations"] as $location){ ?>
                                    <option value="<?php echo sprintf("%s", $location['codeDep']);?>"><?php echo sprintf("%s (%s)", $location['dep'], $location['codeDep']);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark border-0 w-100 py-3">Rechercher</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- Search End -->

            
        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Les 20 dernières annonces</h1>
                    <!-- <p>Top catégories les plus pertinentes cette semaine</p> -->
                </div>
            </div>

        </div>

        <div class="container-fluid  mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                <div class="container">
                    <div class="col-md-12 d-flex flex-wrap justify-content-evenly">
                        <div class="row g-2">
                            <?php foreach ($GLOBALS["lesAnnonces"] as $annonce) { ?>
                                <div class="col-md-4 mt-4">
                                <div class="card">
                                    <img style="max-height: 200px; min-height: 200px" src="<?php echo sprintf("%sTemplate/real-estate-html-template/%s", $GLOBALS['__HOST__'], $annonce['photo']) ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div style="height: fit-content; width: fit-content; max-width: 60%"><h5 class="card-title"><?= $annonce['titre'] ?></h5></div>
                                            <div style="height: fit-content; width: fit-content"><span class='badge' style="display: inline-block; margin: auto; height:fit-content; width:fit-content; text-align:center; padding: 5px 10px"><b style="font-size: 1.2rem;">25 €</b> </span></div>
                                        </div>
                                        <p class="card-text"><?= $annonce["description"] ?></p>
                                        <a href="#" class="btn btn-primary">Détails</a>
                                    </div>
                                </div>
                            </div>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
                
                
                
        <!-- Category End -->