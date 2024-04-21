<!-- Search Start -->
<div class="container-fluid bg-primary mb-5 mt-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <form action="<?php echo $GLOBALS['__HOST__']?>search" method="POST">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select name="category" class="form-select border-0 py-3">
                                <option value="" selected>Catégories</option>
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
                                <option value="" selected>Choisissez la localisation</option>
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
 

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-12">
                <div class="text-center mx-auto mb-2 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">Nous avons trouvé <?php echo count($GLOBALS['resultSearch']); ?> annonce(s) </h1>
                    <p>Vous consultez les annonces en ligne</p>
                </div>
            </div>
            
        </div>
    </div> 
</div>

<!-- Property List Start -->
<?php if (!empty($GLOBALS["resultSearch"])) { ?>
                <div class="container-fluid  mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                    <div class="container">
                        <div class="col-md-12 d-flex flex-wrap" >
                            <?php foreach ($GLOBALS['resultSearch'] as $annonce) { ?>
                                <div class="col-md-4 p-2" style="border-radius: 20px;">
                                    <div class="card" style="min-height: 100%; border-radius: 20px;">
                                        <img style="max-height: 200px; min-height: 200px; border-top-left-radius: 20px; border-top-right-radius: 20px" src="<?php echo sprintf("%sAssets/%s", $GLOBALS['__HOST__'], $annonce['photo']) ?>" class="card-img-top" alt="...">
                                        <div class="card-body" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div style="height: fit-content; width: fit-content; max-width: 60%"><h5 class="card-title"><?= $annonce['titre'] ?></h5></div>
                                                <div style="height: fit-content; width: fit-content"><span class='badge' style="display: inline-block; margin: auto; height:fit-content; width:fit-content; text-align:center; padding: 5px 10px"><b style="font-size: 1.2rem;"><?= $annonce["prix"] ?> €</b> </span></div>
                                            </div>
                                            <p class="card-text"><?= $annonce["description"] ?></p>
                                            <a href="<?php echo sprintf("%s%s/%s", $GLOBALS['__HOST__'], "detail", ($annonce["idAnnonce"]) * 6895) ?>" class="btn btn-primary">Détails</a>
                                        </div>
                                    </div>
                                </div>
                            <?php  }  ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- Property List End -->

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>