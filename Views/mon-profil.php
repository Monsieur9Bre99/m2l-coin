<?php if(isset($_SESSION["idU"])  && ($_SESSION["idU"] != NULL)) { ?>
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <?php if((isset($_SESSION["message"]) && ($_SESSION["message"] != NULL))){ ?>
                <div class="d-flex justify-content-center">
                    <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-6  alert alert-<?= $_SESSION["status"] ?>" role="alert">
                        <i class="fa <?= $_SESSION["icone"]?> fa-2x me-3" aria-hidden="true"></i>
                        <strong><?= $_SESSION["message"] ?></strong> 
                    </div>
                </div>    
            <?php unset($_SESSION["icone"]); unset($_SESSION["status"]); unset($_SESSION["message"]); }?>

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Bonjour !</h1>
            </div>
            <div class="row g-4 d-flex justify-content-between">
                <div class="col-md-5">
                    <form id="form-update-mdp" action="<?php echo $GLOBALS['__HOST__']?>update-mdp" method="POST">   
                        <div class="row g-4"> 
                        <p style="text-align: center;"><em>Veuillez remplir ce formulaire si vous souhaitez modifier votre mot de passe.</em></p>
                            <div class="col-md-12 mx-auto mb-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="apwd" id="aPassword" placeholder="Ancien mot de passe">
                                    <i class="far fa-eye-slash" id="icone-apwd"></i>
                                    <label for="password-sign-up">Ancien mot de passe</label>
                                    <div class="error error-amdp"></div>
                                </div>
                            </div>

                            <div class="col-md-12 mx-auto mb-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="pwd" id="password" placeholder="Nouveau mot de passe">
                                    <i class="far fa-eye-slash" id="icone-pwd"></i>
                                    <label for="password-sign-up">Nouveau mot de passe</label>
                                    <div class="error error-mdp"></div>
                                </div>
                            </div>
                            <div class="col-md-12 mx-auto mb-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="cpwd" id="cPassword" placeholder="Confirmer mot de passe">
                                    <i class="far fa-eye-slash" id="icone-cpwd"></i>
                                    <label for="password-sign-up">Confirmer Mot de passe</label>
                                    <div class="error error-cmdp"></div>
                                </div>
                            </div>
                            <div class="d-grid col-md-6 mx-auto mt-5">
                                <button type="submit" id="bouton-modifMdp" class="btn btn-primary w-100 py-3" name="bouton-modifMdp">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-5">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        
                        <form id="form-update-user" action="<?php echo $GLOBALS['__HOST__']?>update-infos" method="POST">
                            <div class="row g-4">
                            <p style="text-align: center;"><em>Veuillez remplir ce formulaire si vous souhaitez modifier vos informations personnelles.</em></p>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nom" id="nom" value="<?=$GLOBALS["userInfos"]["nom"]?>" placeholder="Nom">
                                        <label for="name-sign-up">Nom</label>
                                        <div class="error error-nom"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?=$GLOBALS["userInfos"]["prenom"] ?>" placeholder="Prénom">
                                        <label for="name-sign-up">Prénom</label>
                                        <div class="error error-prenom"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="email" id="email" value="<?=$GLOBALS["userInfos"]["adresseEmail"] ?>" placeholder="Email">
                                        <label for="email-sign-up">Email</label>
                                        <div class="error error-email"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" name="tel" id="tel" value="<?=$GLOBALS["userInfos"]["telephone"] ?>" placeholder="Téléphone">
                                        <label for="tel-sign-up">Téléphone</label>
                                        <div class="error error-tel"></div>
                                    </div>
                                </div>
                                
                                <div class="d-grid col-md-6 mx-auto">
                                    <button type="submit" id="bouton-modifInfos" class="btn btn-primary w-100 py-3" name="bouton-modifInfos">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>
        //On cible le formulaire d'inscription
        let formMdp   = document.querySelector("#form-update-mdp");
        let formInfos = document.querySelector("#form-update-user");
        console.log(formMdp)

        //On récupère les différents champs
        let nom    = formInfos.nom;
        let prenom = formInfos.prenom;
        let email  = formInfos.email;
        let tel    = formInfos.tel;
        let mdp    = formMdp.pwd;
        let amdp   = formMdp.apwd
        let cmdp   = formMdp.cpwd

        //On récupère les boutons d'envoie de formulaire
        let boutonMdp   = document.querySelector("#bouton-modifMdp");
        let boutonInfos = document.querySelector("#bouton-modifInfos");
        
        //Cas du nom 
        nom.addEventListener("change", function()
        {
            nomValidator(this);
        })

        let nomValidator = function(inputNom)
        {
            let error = document.querySelector(".error-nom");
            let videNom = inputNom.value.trim();

            if(videNom.length == 0)
            {
                nom.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else if(videNom.length < 2)
            {
                nom.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Veuillez entrer deux caractères minimum !!";
                return false;
            }
            else
            {  
                nom.style.border = "";
                error.style.display = "none";
                return true;
            }   
        }

        //Cas du prénom 
        prenom.addEventListener("change", function()
        {
            prenomValidator(this);
        })

        let prenomValidator = function(inputPrenom)
        {
            let error = document.querySelector(".error-prenom");
            let videPrenom = inputPrenom.value.trim();

            if(videPrenom.length == 0)
            {
                prenom.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else if(videPrenom.length < 2)
            {
                prenom.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Veuillez entrer deux caractères minimum !!";
                return false;
            }
            else
            {  
                prenom.style.border = "";
                error.style.display = "none";
                return true;
            }   
        }

        //Cas de l'adresse email
        email.addEventListener("change", function()
        {
            emailValidator(this);
        })

        let emailValidator = function(inputEmail)
        {
            let error = document.querySelector(".error-email");
            let videEmail = inputEmail.value.trim();

            if(videEmail.length == 0)
            {
                email.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else
            { 
                let emailRegExp = new RegExp("^[a-z0-9.-]+[@]{1}[a-z0-9.-]+[.]{1}[a-z]{2,10}$", "g"); //le g a la fin c'est pour dire que c'est une vérification stricte
                let testEmail = emailRegExp.test(inputEmail.value);


                if(!testEmail)
                {
                    email.style.border = "1px solid rgb(243, 41, 41)";
                    error.style.display = "block";
                    error.textContent = "Veuillez entrer une adressse email valide";
                    return false;
                }
                else
                {
                    email.style.border = "";
                    error.style.display = "none";
                    return true;
                }
            }
        }

        //cas du numéro de telephone
        tel.addEventListener("change", function()
        {
            telValidator(this);
        })

        let telValidator = function(inputTel)
        {
            let error = document.querySelector(".error-tel");
            let videTel = inputTel.value.trim();

            if(videTel.length == 0)
            {
                tel.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else
            { 
                let telRegExp = new RegExp("(0|\\+33|0033)[1-9][0-9]{8}", "g"); //le g a la fin c'est pour dire que c'est une vérification stricte
                let testTel = telRegExp.test(inputTel.value);


                if(!testTel)
                {
                    tel.style.border = "1px solid rgb(243, 41, 41)";
                    error.style.display = "block";
                    error.textContent = "Veuillez entrer un numéro de téléphone valide ";
                    return false;
                }
                else
                {
                    tel.style.border = "";
                    error.style.display = "none";
                    return true;
                }
            }
           
        }

        formInfos.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((nomValidator(nom)) & (prenomValidator(prenom)) & (emailValidator(email)) & (telValidator(tel)))
            {
                formInfos.submit();
            }
        })

        //Ancien mot de passe
        amdp.addEventListener("change", function()
        {
            apwdValidator(this);
        })
        
        let apwdValidator = function(inputAmdp)
        {
            let videAmdp = inputAmdp.value.trim();
            let error = document.querySelector(".error-amdp");

            if(videAmdp.length == 0)
            {
                amdp.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else
            {
                
                amdp.style.border = "";
                error.style.display = "none";
                return true;
                
            }
        }

        //cas du mot de passe
        mdp.addEventListener("change", function()
        {
            pwdValidator(this);
        })
        
        let pwdValidator = function(inputMdp)
        {
            let videMdp = inputMdp.value.trim();
            let error = document.querySelector(".error-mdp");

            if(videMdp.length == 0)
            {
                mdp.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else
            {
                let mdpRegExp = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&,;:§%^/*-]).{8,16}$", "g"); //le g a la fin c'est pour dire que c'est une vérification stricte
                let testMdp = mdpRegExp.test(inputMdp.value);
              
                if(!testMdp)
                {
                    mdp.style.border = "1px solid rgb(243, 41, 41)";
                    error.style.display = "block";
                    error.textContent = "Votre mot de passe n'est pas au bon format";
                    return false;
                }
                else
                {
                    mdp.style.border = "";
                    error.style.display = "none";
                    return true;
                }
                
            }
        }

        //cas de la validation du mot de passe
       
        cmdp.addEventListener("change", function()
        {
            cpwdValidator(this);
        })
        
        let cpwdValidator = function(inputCmdp)
        {
            let videCmdp = inputCmdp.value.trim();
            let videMdp = mdp.value.trim();
            let error = document.querySelector(".error-cmdp");
            console.log(mdp.value);
            if(videCmdp.length == 0)
            {
                cmdp.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Champ obligatoire!! Veuillez le remplir";
                return false;
            }
            else if (videCmdp != videMdp) 
            {
                cmdp.style.border = "1px solid rgb(243, 41, 41)";
                error.style.display = "block";
                error.textContent = "Les deux mots de passe ne correspondent pas ";
                return false;
                
            }
            else
            {
                cmdp.style.border = "";
                error.style.display = "none";
                return true;
            }
        }
        
        formMdp.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((apwdValidator(amdp)) & (pwdValidator(mdp)) & (cpwdValidator(cmdp)))
            {
                formMdp.submit();
            }
        })



        //Les icones des input type password
        let iApwd = document.querySelector("#icone-apwd");
        let aPassword = document.querySelector("#aPassword");

        iApwd.classList.add("fa-eye-slash");
        iApwd.addEventListener("click" , function() 
        {
            iApwd.classList.toggle("active");
            if(iApwd.classList.contains("active"))
            {
                aPassword.type = "text";
                iApwd.classList.remove("fa-eye-slash");
                iApwd.classList.add("fa-eye");
            }
            else 
            {
                aPassword.type = "password";
                iApwd.classList.add("fa-eye-slash");
            }
        })

        let iPwd = document.querySelector("#icone-pwd");
        let password = document.querySelector("#password");

        iPwd.classList.add("fa-eye-slash");
        iPwd.addEventListener("click" , function() 
        {
            iPwd.classList.toggle("active");
            if(iPwd.classList.contains("active"))
            {
                password.type = "text";
                iPwd.classList.remove("fa-eye-slash");
                iPwd.classList.add("fa-eye");
            }
            else 
            {
                password.type = "password";
                iPwd.classList.add("fa-eye-slash");
            }
        })

        let iCpwd = document.querySelector("#icone-cpwd");
        let cPassword = document.querySelector("#cPassword");

        iCpwd.classList.add("fa-eye-slash");
        iCpwd.addEventListener("click" , function() 
        {
            iCpwd.classList.toggle("active");
            if(iCpwd.classList.contains("active"))
            {
                cPassword.type = "text";
                iCpwd.classList.remove("fa-eye-slash");
                iCpwd.classList.add("fa-eye");
            }
            else 
            {
                cPassword.type = "password";
                iCpwd.classList.add("fa-eye-slash");
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