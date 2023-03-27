 
 <!-- Property List Start -->
    <div class="container-xxl py-5">
            <div class="container">
            <?php if(($GLOBALS["userAnnonces"]) == NULL ){ ?> 
                    <div class="d-flex justify-content-center">
                        <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-5  alert alert-danger"] >
                            <i class="fa fa-exclamation-circle fa-2x me-3" aria-hidden="true"></i>
                            <strong>Vous n'avez aucune annonce pour le moment !!</strong> 
                        </div>
                    </div>
                    
            <?php }else{?>
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-12">
                        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                            <h1 class="mb-3"><?= $_SESSION['prenom'].' '.$_SESSION['nom']?>, voici vos annonces :</h1>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <?php foreach($GLOBALS['userAnnonces'] as $annonce){ ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden " style="max-height: 200px; text-align: center ">
                                        <a href="<?php echo sprintf("%smodifier-annonce/%s", $GLOBALS['__HOST__'], $annonce['idAnnonce'])?>"><img class="img-fluid" style="height:100%;" src="<?php echo sprintf("%sTemplate/real-estate-html-template/%s", $GLOBALS['__HOST__'], $annonce['photo']) ?>" alt="Image de l'annonce"></a>
                                        <!-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Annonce</div> -->
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="<?php echo sprintf("%sdetails-annonce/%s", $GLOBALS['__HOST__'], $annonce['idAnnonce'])?>"><?php echo sprintf("%s", $annonce['titre']); ?></a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo sprintf("%s", $annonce['dep']); ?></p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar text-primary me-2"></i><?php echo sprintf("Ajouté le %s", date_format(date_create($annonce['dateAjout']), "d/m/Y à H:i")); ?></small>
                                        <!--<small class="flex-fill text-center border-end py-2"><a href="<?php echo $GLOBALS['__HOST__']?>add-to-favoris/<?php echo $annonce['idAnnonce']; ?>"><i class="fa fa-heart text-primary me-2"></i></a></small>-->
                                        <small class="flex-fill text-center border-end py-2"><a style="color: blue;" href="<?php echo $GLOBALS['__HOST__']?>update-annonce/<?php echo $annonce['idAnnonce']; ?>"><i class="fa fa-cog me-1" style="color: blue;"></i> Modif.</a></small>
                                        <small class="flex-fill text-center py-2"><a style="color: red;" href="<?php echo $GLOBALS['__HOST__']?>delete-annonce/<?php echo $annonce['idAnnonce']; ?>"><i class="fa fa-trash  me-1" style="color: red;"></i> Suppr.</a></small>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- Property List End -->

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>