<?php if(isset($_SESSION["idU"])  && ($_SESSION["idU"] != NULL)) { ?>
<style>
    .une-conv
    {
        color: blue;
    }

    .une-conv:hover
    {
        color: #0E2E50;
    }

    .btn-success:hover
    {
        background-color: #f2edf3;
        color: #ff6e14;
        border: 1px solid #ff6e14;
    }
</style>

<?php 
    date_default_timezone_set('Europe/Paris');
?> 
    <!-- partial -->
    <div class="container-fluid page-body-wrapper mt-5">

        <?php if((isset($_SESSION["message"]) && ($_SESSION["message"] != NULL))){ ?>
            <div class="d-flex justify-content-center mt-3" >
                <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-5  alert alert-<?= $_SESSION["status"] ?>" role="alert">
                    <i class="fa <?= $_SESSION["icone"]?> fa-2x me-3" aria-hidden="true"></i>
                    <strong><?= $_SESSION["message"] ?></strong> 
                </div>
            </div>
                
        <?php unset($_SESSION["icone"]); unset($_SESSION["status"]); unset($_SESSION["message"]); }?>

        <div class="main-panel">
            <div class="content-wrapper container">

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary py-3 mb-4 text-center d-md-none aside-toggler"><i class="mdi mdi-menu mr-0 icon-md"></i></button>
                        <div class="card chat-app-wrapper">
                            <div class="row mx-0">
                                <div class="col-lg-3 col-md-4 chat-list-wrapper px-0">
                                    <div class="chat-list-item-wrapper">
                                        <?php
                                            foreach($GLOBALS["listConv"] as $uneConv){
                                                $lastMessage = $GLOBALS["maTabMes"][$uneConv["idConversation"]]["contenu"];
                                                //  pour chaque message dans la liste de message on demande le dernier message envoyé avec order by desc limit 1 
                                            
                                                $infoCorresConv = $GLOBALS["maTabUtil"][$uneConv["idConversation"]];
                                                // on recupere les informations de l'user 

                                        ?>
                                                <a  class="une-conv" style="outline: none; text-decoration: none;"  href="<?php echo sprintf("%sconversation/%s", $GLOBALS['__HOST__'], ($uneConv["idConversation"] * 7649)) ?>"> <!--  cliquer sur la conevrsation? -->
                                                    <div class="list-item">
                                                        <div class="profile-image">
                                                            <img class="img-sm rounded-circle" style="height: 50px; width: 50px" src="<?php echo sprintf("%sAssets/img/annonce/avatarbasique.jpg", $GLOBALS['__HOST__']) ?>" alt="">
                                                        </div>
                                                        <p class="user-name"><?=$infoCorresConv["prenom"]." ".substr($infoCorresConv["nom"], 0, 1). "."?></p>
                                                        <p class="chat-time"><?= date("d M, Y ",strtotime($GLOBALS["maTabMes"][$uneConv["idConversation"]]["dateEnvoi"]))?></p>
                                                        <p class="chat-text"><?=$lastMessage?></p>
                                                    </div>
                                                </a>
                                            
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-8 px-0 d-flex flex-column">
                                    <div class="chat-container-wrapper" style="height: 350px">
                                        <?php
                                            if(isset($GLOBALS["listMes"])){
                                                if ($GLOBALS["listMes"] != NULL) {
                                                    foreach($GLOBALS["listMes"] as $unMess){
                                                        if($unMess["idSender"] == $_SESSION["idU"]){ ?>
                                                            <div class="chat-bubble outgoing-chat" >
                                                                <div class="chat-message" style="background-color: #FF6922">
                                                                <p style="font-weight: bold; color: #0E2E50">Moi</p><hr style="margin-top: -10px;">
                                                                    <p><?=$unMess["contenu"]?></p>
                                                                </div>
                                                                <div class="sender-details">
                                                                    <img class="sender-avatar img-xs rounded-circle" style="height: 40px; width:40px" src="<?php echo sprintf("%sAssets/img/annonce/avatarbasique.jpg", $GLOBALS['__HOST__']) ?>" alt="profile image">
                                                                    <p class="seen-text">Envoyé le: <?= date("d M, Y  - H:i",strtotime($unMess["dateEnvoi"]))?></p>
                                                                </div>
                                                            </div>
                                                
                                                        <?php   }else{ ?>
                                                            <div class="chat-bubble incoming-chat"  style="max-width: 75%; min-width: 75%">
                                                                <div class="chat-message">
                                                                    <p style="font-weight: bold; color: #0E2E50"><?=$GLOBALS["tabInfoSender"][$unMess["idM"]]["prenom"]?> <?=$GLOBALS["tabInfoSender"][$unMess["idM"]]["nom"]?></p><hr style="margin-top: -10px;">
                                                                    <p><?=$unMess["contenu"]?></p>
                                                                </div>
                                                                <div class="sender-details">
                                                                    <img class="sender-avatar img-xs rounded-circle" style="height: 40px; width:40px" src="<?php echo sprintf("%sAssets/img/annonce/avatarbasique.jpg", $GLOBALS['__HOST__']) ?>" alt="profile image">
                                                                    <p class="seen-text">Reçu le : <?= date("d M, Y  - H:i",strtotime($unMess["dateEnvoi"]))?></p>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                    }
                                                }
                                            }?>
                                    </div>

                                    <div class="chat-text-field mt-auto">
                                        <form action="<?=$GLOBALS["__HOST__"] ?>nouveau-message" method="post">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="message" placeholder="Entrez votre message">
                                                <input type="hidden" name="idConv" value="<?=$GLOBALS["currentIdConv"]?>">
                                                <input type="hidden" name="destinataire" value="<?=$GLOBALS["destinataire"]?>">
                                                <div class="input-group-append">
                                                    <input class="btn btn-success" type="submit" name="bout_mess" value="Envoyer">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>


                                <?php 
                                    if(isset($GLOBALS["infoAnn"])): 
                                        if ($GLOBALS["infoAnn"] != NULL) : ?>
                                            <div class="col-lg-3 d-none d-lg-block  chat-sidebar p-2">
                                                <img  class="img-fluid w-100" src='<?php echo sprintf("%sAssets/%s", $GLOBALS['__HOST__'], $GLOBALS["infoAnn"]['photo']) ?>' alt="Annonce image">
                                                <div class="px-4">
                                                    <div class="d-flex pt-4">
                                                        <div class="wrapper">
                                                            <h5 class="font-weight-medium mb-0 ellipsis"><?= $GLOBALS["infoAnn"]["titre"] ?></h5>
                                                        </div>
                                                        <div class="badge  mb-auto ms-auto"><?= $GLOBALS["infoAnn"]["prix"] ?> €</div>
                                                    </div>
                                                    <div class="pt-3">
                                                        <div class="d-flex align-items-center py-1">
                                                            <p class="mb-0 font-weight-medium"><?= $GLOBALS["infoAnn"]["description"] ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endif; ?>    
                                <?php endif; ?>
                                <!-- affichage de l'annonce pour lequel il y a conversation -->
                            </div>
                        </div>
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
        <script>window.location.replace("http://127.0.0.1/m2l-coin/connexion")</script>
    <?php } 
?>