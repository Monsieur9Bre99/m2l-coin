<?php if(isset($_SESSION["idU"])  && ($_SESSION["idU"] != NULL)) { ?>
<style>
    body
    {
        background-color: #f2edf3;
    }

    .btn-inverse-warning
    {
        padding: 1rem;
    }

    .modal-dialog
    {
        padding: 9rem 0;
    }

    .modal-footer .btn-success:hover
    {
        background-color: #f2edf3;
        color: #ff6e14;
        border: 1px solid #ff6e14;
    }
   
    .badge
    {
        max-width: 20%;
        padding: .4rem 0     ;
        /*border-radius: 20px; */
    }
</style>

    <div class="container-xxl py-5">
        <div class="container">
            <?php if((isset($_SESSION["message"]) && ($_SESSION["message"] != NULL))){ ?>
                <div class="d-flex justify-content-center">
                    <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-5  alert alert-<?= $_SESSION["status"] ?>" role="alert">
                        <i class="fa <?= $_SESSION["icone"]?> fa-2x me-3" aria-hidden="true"></i>
                        <strong><?= $_SESSION["message"] ?></strong> 
                    </div>
                </div>
                
            <?php unset($_SESSION["icone"]); unset($_SESSION["status"]); unset($_SESSION["message"]); }?>

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 70%">
                <h1 class="mb-3">Voici le détail de cette annonce :</h1> 
            </div>
            
            <div class="container-fluid page-body-wrapper mt-5">
                <div class="main-panel">
                    <div class="content-wrapper container">
                        <div class="row" >
                            <div class="col-lg-4 grid-margin stretch-card">
                                <div class="card" style="min-height: 100%; background: #ffffff; border: none; border-radius: 20px" >
                                    <div class="card-body" style="border: none;border-radius: 20px">
                                        <div class='card rounded hover-shadow' style="border: none">
                                            <div class="card m-3" style="border: none">
                                                <img src='<?php echo sprintf("%sAssets/%s", $GLOBALS['__HOST__'], $GLOBALS["lAnnonce"]['photo']) ?>'>
                                                <br>
                                                
                                                <!-- Si l'utilisateur est connecté -->
                                                <?php if(isset($_SESSION["idU"])): 

                                                    //Si s'il a déja cette ennonce en favoris, le coeur est rempli
                                                    if(($GLOBALS["favoris"]) == FALSE): ?>
                                                        <span class="favorite-button fs-1">
                                                            <a class="btn btn-outline-secondary" href="<?php echo sprintf("%saction-favoris/%s/%s/de",$GLOBALS["__HOST__"], ($_SESSION["idU"] * 3645), ($GLOBALS["lAnnonce"]["idAnnonce"] * 6895))?>" style="display: block; margin: auto; width: 30%">
                                                                <i style="color: #ff0000" class="fa-solid fa-heart"></i> 
                                                            </a>
                                                        </span>
                                            
                                                    <!-- S'il n'a pas enccore cette ennonce en favoris, le coeur est vide -->    
                                                    <?php else: ?>
                                                        <span class="favorite-button fs-1">
                                                            <a class="btn btn-outline-secondary" href="<?php echo sprintf("%saction-favoris/%s/%s/de",$GLOBALS["__HOST__"], ($_SESSION["idU"] * 3645), ($GLOBALS["lAnnonce"]["idAnnonce"] * 6895))?>" style="display: block; margin: auto; width: 30%">
                                                                <i style="color: #ff0000" class="fa-regular fa-heart"></i> 
                                                            </a>
                                                        </span>
                                                    <?php endif; ?>
                                                
                                                <!--S'il n'est pas connecté on le renvoie vers la page de connexion -->   
                                                <?php else: ?>
                                                    <span class="favorite-button fs-1">
                                                        <a class="btn btn-outline-secondary" href="<?php echo sprintf("%sconnexion",$GLOBALS["__HOST__"])?>" style="display: block; margin: auto; width: 30%" >
                                                            <i style="color: #ff0000" class="fa-regular fa-heart"></i> 
                                                        </a>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 grid-margin stretch-card" >
                                <div class="d-flex align-items-center" style="min-height: 100%; background: #ffffff; border-radius: 20px" >
                                    <div class="card-body" style="border: none; border-radius: 20px">
                                        <div class='card rounded hover-shadow' style="border: none;">
                                            <div class="card" style="width: 95%; margin: auto; border: none;">
                                                <h3><?=$GLOBALS["lAnnonce"]["titre"]?><p class="float-end h3"><?= number_format($GLOBALS["lAnnonce"]["prix"], 0, ',', ' ')  ?> €<hr></p></h3>
                                                <?php switch ($GLOBALS["lAnnonce"]["idCategorie"]) {
                                                    case 1 :?>
                                                        <span class="badge badge-pill badge-primary">Véhicule &nbsp<i class="fa fa-car" aria-hidden="true"></i></span>
                                                    <?php break;

                                                    case 2 :?>
                                                        <span class="badge badge-pill badge-success">Mode &nbsp<i class="fa fa-odnoklassniki" aria-hidden="true"></i></span>
                                                    <?php break;

                                                    case 3 :?>
                                                        <span class="badge badge-pill badge-danger">Jeu de société &nbsp<i class="fa fa-gamepad" aria-hidden="true"></i></span>
                                                    <?php break;

                                                    case 4 :?>
                                                        <span class="badge badge-pill badge-info">Jeu vidéo &nbsp<i class="fa fa-gamepad" aria-hidden="true"></i></span>
                                                    <?php break;
                                                    
                                                    case 5 :?>
                                                        <span class="badge badge-pill badge-dark">Livre/BD/Mangas &nbsp<i class="fa fa-book" aria-hidden="true"></i></span>
                                                    <?php break;

                                                    case 6 :?>
                                                        <span class="badge badge-pill badge-light">Musique &nbsp<i class="fa fa-music" aria-hidden="true"></i></span>
                                                    <?php break;

                                                    case 7 :?>
                                                        <span class="badge badge-pill badge-warning">Sport &nbsp<i class="fa fa-futbol-o" aria-hidden="true"></i></span>
                                                    <?php break;

                                                    case 8 :?>
                                                        <span class="badge badge-pill badge-danger">Autres &nbsp<i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
                                                    <?php break;
                                                    default:
                                                        # code...
                                                        break;
                                                } ?>
                                                
                                                <br><p class="fw-bold font-monospace" style="font-size: 1.5rem; color: #0E2E50"><?=$GLOBALS["lAnnonce"]["description"]?></p>
                                                <p class="card-text">
                                                    <p style="font-size: .8rem">Publiée par <strong style="color: #0E2E50"><?=$GLOBALS["lAnnonce"]["nomProprietaire"]?> <?=$GLOBALS["lAnnonce"]["prenomProprietaire"]?></strong></p>
                                                    <p style="font-size: .8rem"><?= date("d M, Y  - H:i",strtotime($GLOBALS["lAnnonce"]["dateAjout"]))?></p>
                                                </p>

                                                <p>
                                                    <?php if(isset($_SESSION["idU"])): 

                                                        if(($_SESSION["idU"]) == ($GLOBALS["lAnnonce"]["idUser"])): ?>
                                                            <button type="button" style="display: none" class="btn btn-inverse-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@fat">Contacter le vendeur</button>

                                                        <?php else:
                                                            if($GLOBALS["conversation"] == 0) : ?>
                                                                <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@fat">Contacter le vendeur</button>
                                                            <?php else: ?>
                                                                <a href="<?php echo sprintf("%smessage/%s/%s",$GLOBALS['__HOST__'], $_SESSION["idU"], $GLOBALS["lAnnonce"]["idAnnonce"] )?>" class="btn btn-inverse-warning">Contacter le vendeur</a>
                                                            <?php endif;
                                                        endif; ?>
                                                        
                                                    <?php else: ?>
                                                        <a href="<?=$GLOBALS['__HOST__']?>connexion" class="btn btn-inverse-warning">Contacter le vendeur</a>
                                                    <?php endif; ?>
                                                <!-- si la personne est connecté alors on demande a la BDD si il y a une conversation en cours sur l'id de l'annonce et avec l'user :  possibilité de contacter le vendeur en cliquant sur le bouton
                                                sinon la personne n'est pas connecté alors on renvoie à la page connexion pour contacter ensuite le vendeur
                                            --></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5 class="modal-title" id="ModalLabel">Nouveau message</h5>
                                            <form action="<?=$GLOBALS["__HOST__"] ?>nouvelle-conversation" method="POST">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                    <textarea class="form-control" name="message" id="message-text"></textarea>
                                                </div>
                                                <input type="hidden" name="idReceveur" value="<?=$GLOBALS["lAnnonce"]["idUser"]?>">
                                                <input type="hidden" name="idAnn" value="<?=$GLOBALS["lAnnonce"]["idAnnonce"]?>">

                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="send" value="Envoyer message" style="padding: .8rem">
                                            </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal" style="padding: .8rem">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- formulaire renvoyant à la methode post afin de faire requete dans le if(isset) -->

                        </div>
                    </div>
                </div>
            </div>
        </div>   
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