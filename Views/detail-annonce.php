<div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class='card rounded hover-shadow'>
                                    <div class="card">
                                        <img src='<?php echo sprintf("%sAssets/%s", $GLOBALS['__HOST__'], $annonce['photo']) ?>' width='350'>
                                        <br>
                                        <span class="favorite-button"><a class="btn btn-danger" href="">
                                            <!-- sur ce bouton la possibilté d'ajouter au favoris, il renvoie à la page action_get : où la requete est effectué -->
                                    <?php
                                    // if(isset($uid)){
                                    //     $verif = $pdo->prepare("SELECT * from favoris where ida = ? and idu = ?");
                                    //     $verif->execute(array($ida, $uid));
                                    //     if($verif->rowCount() == 0){
                                    //         echo '<i style="color: #ff0000" class="fa-regular fa-heart"></i>';
                                    //     }else{
                                    //         echo '<i style="color: #ff0000" class="fa-solid fa-heart"></i>';
                                    //     }
                                    // }else{  ?>
                                         <i style="color: #ff0000" class="fa-regular fa-heart"></i> 
                                    // <?//php// } ?>
                            
                                    </div>

                                    <!-- $uid : on stocke l'id de la personne qui est actuellement connecté
                                    on demande à la bdd l'etat du compteur pour l'id annonce et l'id annonce.

                                    Si il est egale à 0 alors le coeur est vide sinon le coeur est rempli et cela signifie que l'id l'a deja ajoute dans ces favoris 
                                    puis on affiche favoris : 1 ou 0 
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class='card rounded hover-shadow'>
                                    <div class="card">
                                        <h2><?=$titre?><p class="float-end h3"><?= number_format($prix, 0, ',', ' ')  ?> €</p></h2>
                                         
                                        <p><?=$detail?></p>
                                        <p><span class="badge badge-gradient-dark" ><i class="fa-solid fa-eye"></i> <?= $vue ?></span></p>
                                        <p class="card-text"><small class="text-muted float-start"><?=$nom?> <?=$prenom?></small><small class="text-muted"><br><?=$nomVille?><br><?=$date?></small></p>
                                        <p>
                                        <?php if(isset($uid)): ?>
                                            <?php
                                            $verif = $pdo->prepare("SELECT * from conversation where idan = ? and idu = ?");
                                            $verif->execute(array($ida, $uid));
                                            if($verif->rowCount() == 0){  ?>
                                            <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@fat">Contacter le vendeur</button>
                                            <?php }else{
                                                $idc = $verif->fetch();
                                                ?>
                                            <a href="message.php?idc=<?= $idc["idc"]?>" class="btn btn-inverse-warning">Contacter le vendeur</a>
                                            <?php } ?>
                                        <?php else: ?>
                                            <a href="connexion.php" class="btn btn-inverse-warning">Contacter le vendeur</a>
                                        <?php endif; ?>
                                        <!-- si la personne est connecté alors on demande a la BDD si il y a une conversation en cours sur l'id de l'annonce et avec l'user :  possibilité de contacter le vendeur en cliquant sur le bouton
                                        sinon la personne n'est pas connecté alors on renvoie à la page connexion pour contacter ensuite le vendeur
                                    -->
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
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" name="message" id="message-text"></textarea>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" name="send" value="Envoyer message">
                                    </form>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- formulaire renvoyant à la methode post afin de faire requete dans le if(isset) -->

                </div>
            </div>
        </div>
    </div>