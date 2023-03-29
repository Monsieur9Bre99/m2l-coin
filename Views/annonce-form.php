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
                    <h1 class="mb-3">Nouvelle Annonce</h1> 
                </div>
                <div class="bg-light p-5 rounded container">
                    <form enctype="multipart/form-data" method="POST" action="<?=$GLOBALS['__HOST__']?>nouvelle-annonce" class="mt-5 container"id ="form-ajout">
                            
                        <div class="form-floating mb-4 col-md-6 container">
                            <input type="text" class="form-control" id="floatingInput"  name="titre" value="" placeholder="Titre de l'article" >
                            <label for="floatingInput" style="left: 20px">Titre</label>
                            <div class="error error-titre"></div>
                        </div>

                        <div class="form-floating mb-4 col-md-6 container">
                            
                            <select name="categorie" class="form-select">
                                <?php foreach($GLOBALS["categories"] as $category){ ?>
                                <option value="<?php echo $category['idCategorie'];?>"><?php echo sprintf("%s", $category['libelle']);?></option>
                                <?php } ?>
                            </select>
                            
                            <label for="floatingSelect" style="left: 20px">Catégorie</label>
                            <div class="error error-category"></div>
                        </div>

                        <div class="form-floating mb-4 col-md-6 container">
                            <input type="number" class="form-control" id="floatingInput"  name="prix" value="" placeholder="Prix de l'article" >
                            <label for="floatingInput" style="left: 20px">Prix</label>
                            <div class="error error-prix"></div>
                        </div>

                        <div class="form-floating mb-4 col-md-6 container">
                            <input type="file" class="form-control" id="floatingInput" name="image" value=""  required>
                            <label for="floatingInput" style="left: 20px">Photo</label>
                            <div class="error error-image"></div>
                        </div>

                        <div class="form-floating mb-4 col-md-6 container">
                            
                            <select name="localisation"  class="form-select">
                                <!-- <option selected>Choisissez la localisation</option> -->
                                <?php foreach($GLOBALS["locations"] as $location){ ?>
                                <option value="<?php echo sprintf("%s", $location['codeDep']);?>"><?php echo sprintf("%s (%s)", $location['dep'], $location['codeDep']);?></option>
                                <?php } ?>
                            </select>

                            <label for="floatingSelect" style="left: 20px">Localisation</label>
                            <div class="error error-location"></div>
                        </div>

                        <div class="form-floating mb-5 col-md-6 container">
                            <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="descrip"></textarea>
                            <label for="floatingTextarea2" style="left: 20px">Description</label>
                            <div class="error error-descrip"></div>
                        </div>
                        <input type="hidden" name="idUser" value="<?=isset($_SESSION["idU"]) ? $_SESSION["idU"] : ''?>">

                        <div class="col-md-6  container">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="modifBouton">Enregistrer  les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contact End -->


        <script>
        let form = document.querySelector("#form-ajout");
        let titre = form.titre;
        let categorie = form.category;
        let localisation = form.location;
        let prix = form.prix;
        let image = form.image;
        let descrip = form.descrip;

       

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

        form.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((titreValidator(titre)) & (prixValidator(prix)) & (imageValidator(image) & (descripValidator(descrip))))
            {
                form.submit();
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
            <script>window.location.replace("http://127.0.0.1/projetLeboncoin/connexion")</script>
        <?php } 
    ?>