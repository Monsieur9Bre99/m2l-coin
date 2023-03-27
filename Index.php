<?php

    include(__DIR__."\\Controllers\\LandingController.php");
    include(__DIR__."\\Controllers\\LoginController.php");
    include(__DIR__."\\Controllers\\AnnonceController.php");
    include(__DIR__."\\Controllers\\SearchController.php");
    include(__DIR__."\\Controllers\\UpdateController.php");

    class Index{

        // Constructeur
        private function __construct()
        {
            return;
        }
        
        // webApplication Launcher...
        public static function main(){
            // Config pour Assets...
            $GLOBALS['__HOST__'] = "http://127.0.0.1/projetLeboncoin/";
            $GLOBALS['WINDOW_TITLE'] = "Bienvenue sur le site leboncoin de petites annonces";
            // $_SERVER['REDIRECT_QUERY_STRING'] ce parm me permet de savoir est ce que l'user souhaite aller sur la page d'accueil ou consulter une autre page
            // En fonction de la redirection (action exemple se connecter se deconnecter, créer une annonce...etc) demandée
            // [REDIRECT_QUERY_STRING] => url=toto
            // Ici si pas de route de demander alors on revoit vers la page d'accueil.
            // isset <=> exist

            if(isset($_SERVER['REDIRECT_QUERY_STRING']) && ($_SERVER['REDIRECT_QUERY_STRING'] != NULL || $_SERVER['REDIRECT_QUERY_STRING'] != ''))
            { 
                $root = str_replace("url=", "", $_SERVER['REDIRECT_QUERY_STRING']);
             
                switch(strtolower($root)){
                    case "inscription-form":// TODO: First Example
                        $controller = new LoginController("inscription");
                        break;

                    case "inscription":// TODO: First Example
                        $controller = new LoginController();
                        $controller->inscriptionUser();
                        break;

                    case "connexion":// TODO: First Example
                        $controller = new LoginController("connexion");
                        break;
                    
                    case "check-connection":
                        $controller = new LoginController(); // je ne charge pas la vue par contre j'execute la fonction en dessous...
                        $controller->checkConnection();
                        break;

                    case "deconnexion": // TODO:
                        $controller = new LoginController(); // je ne charge pas la vue par contre j'execute la fonction en dessous...
                        $controller->killSession();
                        break;

                    case "deposer-une-annonce": // TODO:
                        $controller = new AnnonceController("annonce-form");
                        break;
                       
                    case "nouvelle-annonce": // TODO:
                        $controller = new AnnonceController();
                        $controller->nouvelleAnnonce();
                        break;

                    case preg_match('/modifier-annonce.*/', strtolower($root)) ? true : false: // TODO:
                        $urlSplited = explode('/', $_SERVER['REQUEST_URI']) ; //On divise le chemin selon le critère "/"
                        $a = $urlSplited[(count($urlSplited) -1)]; // On accède ensuite à l'id de l'annonce
                        $GLOBALS['id'] = (int)$a;
                        if ($GLOBALS['id'] == 0) 
                        {
                            echo"Id non reconnu !!";
                        }
                        else
                        {
                            $controller = new UpdateController("update");
                        }
                        
                        break;

                    case "supprimer-une-annonce":
                        echo "Supprimer une annonce";
                        break;

                    case "mes-annonces":
                        $controller = new AnnonceController();
                        $controller->getUserAnnonces();
                        break;

                    case "mes-favoris":
                        $controller = new AnnonceController();
                        $controller->mesFavoris();
                        break;

                    case "account":
                        $controller = new LoginController("account");
                        break;
                    case preg_match('/search?.*/', strtolower($root)) ? true : false: // TODO:
                        $controller = new SearchController();
                        $controller->getResultSearch();
                        break;
                        
                    case "resultsearch":
                        $controller = new SearchController('resultsearch');
                        echo "Load";
                        break;
                    default: // TODO:
                        echo "URL NOT FOUND 404 !";
                }
            }
            else
            {
                // Si je suis dans le ELSE je dois aller vers l'HOME...
                // Cas ou on doit redériger vers la page d'accueil;
                $controller = new LandingController("home");
            }
        }
    }
    
    // Start WebApp
    Index::main();
?>