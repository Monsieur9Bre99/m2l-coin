<?php if(isset($_SESSION["idU"])  && ($_SESSION["idU"] != NULL)) { ?>
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

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Modification d'annonce</h1> 
            </div>
            
            <div class="row g-4 d-flex justify-content-between">
                <div class="bg-light p-5 col-md-5">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-align-center mb-3">Image</h4>
                                <img style="height: fit-content; width: 600px" src="../Assets/<?= $GLOBALS["lAnnonce"]["photo"]?>" alt="image" class="img-fluid mb-3">
                                <form class="mt-3" enctype="multipart/form-data" action="<?=$GLOBALS['__HOST__']?>valider-modif-image-annonce" method="POST" id="formImg"> <!-- formumlaire de modification de l'avatar -->
                                    <div class="form-floating mb-5 col-md-12 container">
                                        <input type="file" class="form-control" id="floatingInput" name="image" value="">
                                        <input type="hidden" class="form-control" id="floatingInput" name="titre" value="<?= $GLOBALS["lAnnonce"]["titre"] ?>">
                                        <input type="hidden" class="form-control" id="floatingInput" name="idAnnonce" value="<?= $GLOBALS["lAnnonce"]["idAnnonce"] ?>">
                                        <label for="floatingInput" style="padding-left: 40px;">Photo</label>
                                        <div class="error error-image"></div>
                                    </div>

                                    <div class="col-md-12  container">
                                        <button class="btn btn-primary w-100 py-3" type="submit" name="modifImgBouton">Modifier l'image</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-2 col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.5s"> 
                        <div class=" rounded container">
                            <form enctype="multipart/form-data" method="POST" action="<?=$GLOBALS['__HOST__']?>valider-modif-infos-annonce" class="mt-5 container" id ="formInfos">
                                    
                                <div class="form-floating mb-4 col-md-12 ">
                                    <input type="text" class="form-control" id="floatingInput"  name="titre" value="<?= $GLOBALS["lAnnonce"]["titre"] ?>" placeholder="Titre de l'article" >
                                    <label for="floatingInput"  >Titre</label>
                                    <div class="error error-titre"></div>
                                </div>

                                <div class="form-floating mb-4 col-md-12 ">
                                   
                                    <?php echo $GLOBALS["selectedCat"] ?>
                                    
                                    <label for="floatingSelect"  >Catégorie</label>
                                    <div class="error error-category"></div>
                                </div>

                                <div class="form-floating mb-4 col-md-12 ">
                                    <input type="number" class="form-control" id="floatingInput"  name="prix" value="<?= $GLOBALS["lAnnonce"]["prix"] ?>" placeholder="Prix de l'article" >
                                    <label for="floatingInput"  >Prix</label>
                                    <div class="error error-prix"></div>
                                </div>

                                
                                <div class="form-floating mb-4 col-md-12 ">
                                    
                                    <?php echo $GLOBALS["selectedLoc"] ?>

                                    <label for="floatingSelect"  >Localisation</label>
                                    <div class="error error-location"></div>
                                </div>

                                <div class="form-floating mb-5 col-md-12 ">
                                    <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="descrip"><?= $GLOBALS["lAnnonce"]["description"] ?></textarea>
                                    <label for="floatingTextarea2"  >Description</label>
                                    <div class="error error-descrip"></div>
                                </div>
                                <input type="hidden" name="idUser" value="<?=isset($_SESSION["idU"]) ? $_SESSION["idU"] : ''?>">

                                <input type="hidden" class="form-control" id="floatingInput" name="idAnnonce" value="<?= $GLOBALS["lAnnonce"]["idAnnonce"] ?>">
                                        
                                <div class="col-md-12  container">
                                    <button class="btn btn-primary w-100 py-3" type="submit" name="modifBouton">Enregistrer  les modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


        <script>
        let formInfos = document.querySelector("#formInfos");
        let formImg = document.querySelector("#formImg");
        let titre = formInfos.titre;
        let categorie = formInfos.category;
        let localisation = formInfos.location;
        let prix = formInfos.prix;
        let image = formImg.image;
        let descrip = formInfos.descrip;
        
        let boutonImg = formImg.modifImgBouton;
        console.log(boutonImg);
       

        titre.addEventListener("change", function()
        {
            titreValidator(this);
        })

        let titreValidator = function(inputTitre)
        {
            let error = document.querySelector(".error-titre");
            let videTitre = inputTitre.value.trim();

            if(videTitre.length == 0)
            {
                titre.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else if(videTitre.length < 2)
            {
                titre.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Veuillez entrer deux caractères minimum !!";
                return false;
            }
            else
            {  
                titre.style.border = "";
                error.style.display = "none";
                return true;
            }   
        }

        prix.addEventListener("change", function()
        {
            prixValidator(this);
        })

        let prixValidator = function(inputPrix)
        {
            let error = document.querySelector(".error-prix");
            let videPrix = inputPrix.value.trim();

            if(videPrix.length == 0)
            {
                prix.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else if((videPrix == 0) || (videPrix < 0))
            {
                titre.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Veuillez entrer un prix supérieur à 0 €";
                return false;
            }
            else if(videPrix > 1000)
            {
                titre.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "La limite maximale est de 1 000 €";
                return false;
            }
            else
            {  
                prix.style.border = "";
                error.style.display = "none";
                return true;
            }   
        }

        descrip.addEventListener("change", function()
        {
            descripValidator(this);
        })

        let descripValidator = function(inputDescrip)
        {
            let error = document.querySelector(".error-descrip");
            let videDescrip = inputDescrip.value.trim();
            
            console.log(videDescrip);

            if(videDescrip.length <= 0)
            {
                descrip.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Veuillez ajouter une description à votre produit !!";
                return false;
            }
            
            else
            {  
                descrip.style.border = "";
                error.style.display = "none";
                return true;
            }   
        }

        formInfos.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((titreValidator(titre)) & (prixValidator(prix)) & (descripValidator(descrip)))
            {
                formInfos.submit();
            }
        })

        
        image.addEventListener("change", function()
        {
            imageValidator(this);
        })

        let imageValidator = function(inputImage)
        {
            let error = document.querySelector(".error-image");
            let videImage = inputImage.value;

            if(videImage != 0)
            {
                image.style.border = "";
                error.style.display = "none";
                return true;
            }
            
            else
            {  
                image.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Veuillez ajouter un fichier !!";
                return false;
            }   
        }

        boutonImg.disabled = true;
        image.addEventListener("change", function(e)
        {
            if ((imageValidator(image)))
            {
                boutonImg.disabled = false;
            }
            else
            {
                boutonImg.disabled = true;
            }
        })
        formImg.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((imageValidator(image)))
            {
                formImg.submit();
            }
        })
    </script>

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