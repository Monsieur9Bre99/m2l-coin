<?php if(isset($_SESSION["idU"])  && ($_SESSION["idU"] != NULL)) { ?>
 <!-- Property List Start -->
        
        
        <!-- Property List End -->

        
    <style>
        
        body
        {
            background-color: #f2edf3;}

        tbody td, thead th
        {
            color: #0E2E50;
        } 

    </style>

    <div class="container-xxl py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 70%">
                <h1 class="mb-3">Bienvenue dans votre espace "Favoris" !!</h1> 
        </div>
        <?php if((isset($_SESSION["message"]) && ($_SESSION["message"] != NULL))){ ?>
            <div class="d-flex justify-content-center">
                <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-5  alert alert-<?= $_SESSION["status"] ?> text-center" role="alert">
                    <i class="fa <?= $_SESSION["icone"]?> fa-2x me-3" aria-hidden="true"></i>
                    <strong><?= $_SESSION["message"] ?></strong> 
                </div>
            </div>
                    
        <?php unset($_SESSION["icone"]); unset($_SESSION["status"]); unset($_SESSION["message"]); }?>

        <?php  if($GLOBALS["mesFavoris"] != FALSE) { ?>
            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper">
                    <div class="main-panel">
                        <div class="content-wrapper container">
                            <div class="row">
                                <div class=" grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive mt-3 pb-3" style="height: fit-content;">
                                                <table class="table text-center">
                                                    <thead>
                                                    <tr>
                                                        <th><b>Photo</b></th>
                                                        <th><b>Titre</b></th>
                                                        <th><b>Prix</b></th>
                                                        <th><b>Action</b></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php  foreach ($GLOBALS["mesFavoris"] as $ligne => $unFavoris) { ?>
                                                        <tr class="">
                                                            <?php if ($unFavoris == NULL) { ?>
                                                                <td colspan="4">Cette annonce a été supprimée par son propriétaire</td>
                                                            
                                                            <?php } else { ?>
                                                                <td><img src="<?php echo sprintf("%sAssets/%s", $GLOBALS['__HOST__'], $unFavoris['photo']) ?>" alt="image" style="max-height: 100px; max-width: 100px;"></td>
                                                                <td><?= $unFavoris["titre"] ?></td>
                                                                <td><?= $unFavoris["prix"] ?> €</td>
                                                                <td>
                                                                    <a style="padding: .6rem 1rem" class="btn btn-light" href="<?php echo sprintf("%saction-favoris/%s/%s/fa",$GLOBALS["__HOST__"], ($_SESSION["idU"] * 3645), ($unFavoris["idAnnonce"] * 6895))?>">
                                                                        <i class="fa-solid fa-heart text-primary"></i>
                                                                    </a>
                                                                    <a style="padding: .4rem 1.5rem; font-size: .9rem" href="<?php echo sprintf("%s%s/%s", $GLOBALS['__HOST__'], "detail", ($unFavoris["idAnnonce"]) * 6895) ?>" class="btn btn-inverse-warning mx-2">Voir</a>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>

                                                    <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php 
    }
    else 
    {
        $_SESSION["message"] = "Veuillez vous connecter pour accéder à votre compte.";
        $_SESSION["status"] = "dark";
        $_SESSION["icone"] = "fa-check-circle"; ?>
        <script>window.location.replace("http://127.0.0.1/connexion")</script>
    <?php } 
?>