    
   
   <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <?php if((isset($_SESSION["message"]) && ($_SESSION["message"] != NULL))){ ?>
                <div class="d-flex justify-content-center">
                    <div class="mx-auto d-inline-flex align-items-center mb-5 col-md-5  alert alert-<?= $_SESSION["status"] ?>" role="alert">
                        <i class="fa <?= $_SESSION["icone"]?> fa-2x me-3" aria-hidden="true"></i>
                        <strong><?= $_SESSION["message"] ?></strong> 
                    </div>
                </div>
                
            <?php session_destroy(); }?>

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-1 mt-3">Bonjour !!</h1>
                <p id="sign-in-text" >Connectez-vous pour découvrir toutes nos fonctionnalités.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3"></div>
                <div class="col-md-6 mt-1">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        <form id="form-login" action="<?php echo $GLOBALS['__HOST__']?>check-connection" method="POST">
                            
                            <div class="row g-4">
                                <div class="col-md-9 mx-auto">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        <label for="email">Email</label>
                                        <div class="error error-email"></div>
                                    </div>
                                </div>
                                <div class="col-md-9 mx-auto">
                                    <div class="form-floating">
                                    
                                        <input type="password" class="form-control" name="pwd" id="password" placeholder="Password" >
                                        <span class=""><i class="far fa-eye-slash" id="icone-mdp-connexion"></i></span>
                                        <label for="password">Mot de passe</label>
                                        <div class="error error-mdp"></div>
                                    </div>
                                </div>
                                <div class="d-grid col-md-4 mx-auto">
                                    <button class="btn btn-primary w-100 py-3" type="submit" id="bouton-connexion">Se connecter</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="wow fadeInUp " data-wow-delay="0.5s">
                        <div class="col mx-auto mt-3" style="width: fit-content">
                           Première visite ? <a id="sign-up-href" href="<?php echo $GLOBALS['__HOST__']?>inscription-form" class="switch-mode">Créez un compte</a>
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
        let form = document.querySelector("#form-login");
        let email = form.email;
        let mdp = form.pwd;
        let bouton = document.querySelector("#bouton-connexion");

        email.addEventListener("input", function()
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

        mdp.addEventListener("input", function()
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
                
                mdp.style.border = "";
                error.style.display = "none";
                return true; 
            }
        }


        form.addEventListener("submit", function(e)
        {
            e.preventDefault();
            if ((emailValidator(email)) & (pwdValidator(mdp)))
            {
                form.submit();
            }
        })


        let i = document.querySelector("#icone-mdp-connexion");
        let password = document.querySelector("#password");
        i.classList.add("fa-eye-slash");
        i.addEventListener("click" , function() {
            i.classList.toggle("active");
            if(i.classList.contains("active")) {
                password.type = "text";
                i.classList.remove("fa-eye-slash");
                i.classList.add("fa-eye");
            }else {
                password.type = "password";
                i.classList.add("fa-eye-slash");
            }
        })

    </script>