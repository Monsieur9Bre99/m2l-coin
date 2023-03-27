    
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
            <?php session_destroy(); }?>

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Bonjour !!</h1>
                <p id="sign-in-text" >Inscrivez-vous pour découvrir toutes nos fonctionnalités.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        
                        <form id="form-signUp" action="<?php echo $GLOBALS['__HOST__']?>inscription" method="POST">
                            <div class="row g-4">
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
                                        <label for="name-sign-up">Nom</label>
                                        <div class="error error-nom"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom">
                                        <label for="name-sign-up">Prénom</label>
                                        <div class="error error-prenom"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                        <label for="email-sign-up">Email</label>
                                        <div class="error error-email"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" name="tel" id="tel" placeholder="Téléphone">
                                        <label for="tel-sign-up">Téléphone</label>
                                        <div class="error error-tel"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="pwd" id="password" placeholder="Mot de passe">
                                        <i class="far fa-eye-slash" id="icone-pwd"></i>
                                        <label for="password-sign-up">Mot de passe</label>
                                        <div class="error error-mdp"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="cpwd" id="cPassword" placeholder="Confirmer mot de passe">
                                        <i class="far fa-eye-slash" id="icone-cpwd"></i>
                                        <label for="password-sign-up">Confirmer Mot de passe</label>
                                        <div class="error error-cmdp"></div>
                                    </div>
                                </div>
                                <div class="d-grid col-md-6 mx-auto">
                                    <button type="submit" id="bouton" class="btn btn-primary w-100 py-3" name="bouton-inscription">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="wow fadeInUp " data-wow-delay="0.5s">
                        <div class="col mx-auto mt-3" style="width: fit-content">
                           Vous avez déjà un compte ? <a id="sign-up-href" href="<?php echo $GLOBALS['__HOST__']?>connexion" class="switch-mode">Connectez-vous</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- <script>
        jQuery(document).ready(function($) {
            $("#form-sign-up").hide();
            let signIn = false;
            // Color Changer
            $(".switch-mode" ).click(function(){
                if(signIn === false){
                    signIn = true;
                    let url = $(location).attr('href').replace('log-in#','log-in');
                    $("#form-sign-in").hide();
                    $("#form-sign-up").show();
                    $("#sign-up-href").html("Me connecter");
                    $("#sign-up-href").href = url;
                    $("#sign-in-text").html('Inscrivez vous pour découvrir toutes nos fonctionnalités.');
                }else{
                    let url = $(location).attr('href').replace('#sign-up','');
                    $(location).attr('href', url);
                }
                
            });
        });
    </script> -->

    <script>
        //On cible le formulaire d'inscription
        let form   = document.querySelector("#form-signUp");

        //On récupère les différents champs
        let nom    = form.nom;
        let prenom = form.prenom;
        let email  = form.email;
        let tel    = form.tel;
        let mdp    = form.pwd;
        let cmdp   = form.cpwd
        
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

        //cas de la validation dumot de passe
       
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

        const elements = document.querySelectorAll(".form-floating input");
        elements.forEach(element => {
            element.addEventListener("input", function(e)
            {
                if ((nomValidator(nom)) && (prenomValidator(prenom)) && (emailValidator(email)) && (telValidator(tel)) && (pwdValidator(mdp)) && (cpwdValidator(cmdp)))
                {
                    let bouton = document.querySelector("#bouton");
                    bouton.disabled = false;
                }
                else
                {
                    let bouton = document.querySelector("#bouton");
                    bouton.disabled = true;
                }
            }
            
            )
        });
        
        
        form.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((nomValidator(nom)) & (prenomValidator(prenom)) & (emailValidator(email)) & (telValidator(tel)) & (pwdValidator(mdp)) & (cpwdValidator(cmdp)))
            {
                form.submit();
            }
            else
            {
                let bouton = document.querySelector("#bouton");
                bouton.disabled = true;
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