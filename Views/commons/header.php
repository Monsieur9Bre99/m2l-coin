<?php 
    //session_start();
    // if(isset($_SESSION) && !empty($_SESSION))
    // {
    //     //  var_dump($_SESSION);
    //     //  exit();
    // }else {
    //     echo " C'est pas bon !!";
    // }

    // if ((isset($_SESSION["message"])) && ($_SESSION["message"] != null)) {
    //    var_dump($_SESSION["message"]);
    //    session_destroy();
    // }
    // else{
    //     echo "C'est pas bon";
    // }
    
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $GLOBALS['WINDOW_TITLE']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo $GLOBALS['__HOST__']?>/Assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo $GLOBALS['__HOST__']?>/Assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo $GLOBALS['__HOST__']?>/Assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo $GLOBALS['__HOST__']?>/Assets/css/style.css" rel="stylesheet">
</head>

    <style>
        
        .error
        {
            color: rgb(243, 41 ,41);
            font-size: 1rem;
        }
        .form-floating{
            position: relative;
        }

        #icone-mdp-connexion, #icone-pwd, #icone-cpwd, #icone-apwd{
            display: inline;
            font-size: 21px;
            position: absolute;
            /* bottom : 30%;
            left: 90%; */
            top: 20px;
            right: 15px;
            cursor: pointer;
            
        }
    </style>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Chargement..</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="<?php echo $GLOBALS['__HOST__']?>" class="navbar-brand d-flex align-items-center text-center">
                    <h1 class="m-0 text-primary">M2L-COIN</h1>
                    </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <!--<a href="<?php //echo $GLOBALS['__HOST__'];?>" class="nav-item nav-link active">Accueil</a>-->
                        <?php if(isset($_SESSION["idU"]) && !empty($_SESSION)){ ?> 
                        
                            <a href="<?php echo $GLOBALS['__HOST__']?>mes-annonces" class="nav-link "><i class="fa fa-list text-primary me-1"></i>Mes annonces</a>
                            <a href="<?php echo $GLOBALS['__HOST__']?>mes-favoris" class="nav-link"><i class="fa fa-heart text-primary me-1"></i> Mes favoris</a>
                            <a href="<?php echo $GLOBALS['__HOST__']?>mes-messages" class="nav-link"><i class="fa fa-comments text-primary me-1" aria-hidden="true"></i> Mes messages</a>
                            <!-- <a href="<?php //echo $GLOBALS['__HOST__']?>log-out" class="nav-link"><i class="fa fa-user text-primary me-1"></i> Se déconnecter</a> -->
                        
                            <li class="nav-item dropdown my-auto">
                                <h6 class="nav-link dropdown-toggle my-auto" data-bs-toggle="dropdown" aria-expanded="false" style="text-transform: none;"><b><?= $_SESSION["prenom"]. " " .$_SESSION["nom"] ?></b></h6>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo $GLOBALS['__HOST__']?>mon-profil"><i class="fa fa-user me-2"></i><b>Mon profil</b></a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a class="dropdown-item" href="<?php echo $GLOBALS['__HOST__']?>deconnexion">
                                        <svg height= 20px width= 20px xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                                    <b>Se déconnecter</b></a></li>
                                </ul>
                            </li>
                            
                            <?php }else{ ?>
                            <div class="my-auto" style="margin-right: 70px">
                                <form class="d-flex my-auto" method= "POST" action="<?php echo $GLOBALS['__HOST__']?>search">
                                    <input class="form-control me-2" name="what" type="search" placeholder="Rechercher un article" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                                </form>
                            </div>
                            <a href="<?php echo $GLOBALS['__HOST__']?>connexion" class="nav-link"><i class="fa fa-user text-primary me-1"></i> Se connecter</a>
                        <?php } ?>
                    </div>
                    <a href="<?php echo $GLOBALS['__HOST__']?><?= (isset($_SESSION["idU"])) && ($_SESSION != NULL) ? 'deposer-une-annonce' : 'connexion' ?>" class="btn btn-primary px-3 d-none d-lg-flex nav-link"><i style="margin-top:2%" class="fa fa-plus me-1"></i> Nouvelle annonce</a>
               
                 </div>
            </nav>
        </div>
    </div>
    
        <!-- Navbar End -->