<?php

include(__DIR__ ."//Controllers//LandingController.php");
include(__DIR__ ."//Controllers//AccountController.php");
include(__DIR__ ."//Controllers//AnnonceController.php");
include(__DIR__ ."//Controllers//FavorisController.php");
include(__DIR__ ."//Controllers//SearchController.php");
include(__DIR__."//Controllers//MessageController.php");

class Index
{
    // Constructeur
    private function __construct()
    {
        return;
    }

    // webApplication Launcher...
    public static function main()
    {
        // Config pour Assets...
        $GLOBALS['__HOST__'] = "http://127.0.0.1/";
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
                        $controller = new AccountController("inscription");
                        break;

                    case "inscription":// TODO: First Example
                        $controller = new AccountController();
                        $controller->inscriptionUser();
                        break;

                    case "mon-profil":
                        $controller = new AccountController("mon-profil");
                        break; 

                    case "update-infos":// TODO: First Example
                        $controller = new AccountController();
                        $controller->updateUser();
                        break;

                    case "update-mdp":// TODO: First Example
                        $controller = new AccountController();
                        $controller->updateMdp();
                            break;

                    case "connexion":// TODO: First Example
                        $controller = new AccountController("connexion");
                        break;
                    
                    case "check-connection":
                        $controller = new AccountController(); // je ne charge pas la vue par contre j'execute la fonction en dessous...
                        $controller->checkConnection();
                        break;

                    case "deconnexion": // TODO:
                        $controller = new AccountController(); // je ne charge pas la vue par contre j'execute la fonction en dessous...
                        $controller->killSession();
                        break;

                    case "deposer-une-annonce": // TODO:
                        $controller = new AnnonceController("annonce-form");
                        break;
                       
                    case "nouvelle-annonce": // TODO:
                        $controller = new AnnonceController();
                        $controller->nouvelleAnnonce();
                        break;

                    case preg_match('/delete-annonce.*/', strtolower($root)) ? true : false: // TODO:
                        $urlSplited = explode('/', $_SERVER['REQUEST_URI']) ; //On divise le chemin selon le critère "/"
                        $lid = $urlSplited[(count($urlSplited) -1)]; // On accède ensuite à l'id de l'annonce
                        $GLOBALS["lid"] = (int)$lid;
                        $controller = new AnnonceController();
                        $controller->deleteAnnonce($GLOBALS["lid"]);
                        break;

                    case preg_match('/modifier-annonce.*/', strtolower($root)) ? true : false: // TODO:
                        $urlSplited = explode('/', $_SERVER['REQUEST_URI']) ; //On divise le chemin selon le critère "/"
                        $a = $urlSplited[(count($urlSplited) -1)]; // On accède ensuite à l'id de l'annonce
                        $GLOBALS['lid'] = (int)$a;
                        
                        $controller = new AnnonceController();
                        $controller->recupAnnonce($GLOBALS["lid"]);
                        break;

                    case "valider-modif-image-annonce":// TODO:
                        $controller = new AnnonceController();
                        $controller->validateModifImg();
                        break;   
                        
                    case "valider-modif-infos-annonce":// TODO:
                        $controller = new AnnonceController();
                        $controller->modifAnnonce();
                        break; 

                    case "abc":
                        $controller = new AccountController("algo");
                        break;

                    
                    case preg_match("/detail.*/", strtolower($root)) ? true : false:// TODO:
                        $urlSplited = explode('/', $_SERVER['REQUEST_URI']) ; //On divise le chemin selon le critère "/"
                        $a = $urlSplited[(count($urlSplited) -1)]; // On accède ensuite à l'id de l'annonce
                        $GLOBALS['lid'] = (int)$a;

                        
                        $controller = new AnnonceController();
                        $controller->detailAnnonce($GLOBALS["lid"]);
                        break; 
                        
                    case preg_match("/action-favoris.*/", strtolower($root)) ? true : false: // TODO:
                        
                        $urlSplited = explode('/', $_SERVER['REQUEST_URI']) ; //On divise le chemin selon le critère "/"
                        $idU = $urlSplited[(count($urlSplited) -3)]; // On accède ensuite à l'id de l'utilisateur
                        $idA = $urlSplited[(count($urlSplited) -2)]; // On accède ensuite à l'id de l'annonce
                        $route = $urlSplited[(count($urlSplited) -1)]; // On accède à la route pour la redirection

                        $idU = (int)$idU;
                        $idA = (int)$idA;

                        $controller = new FavorisController();
                        $controller->actionSurFavoris($idU, $idA, $route);
                        break;    


                    case "mes-annonces":
                        $controller = new AnnonceController();
                        $controller->getUserAnnonces();
                        break;

                    case "mes-favoris":
                        $controller = new FavorisController();
                        $controller->favorisUtilisateur($_SESSION["idU"]);
                        break;

                    case preg_match('/search?.*/', strtolower($root)) ? true : false: // TODO:
                        $controller = new SearchController();
                        $controller->getResultSearch();
                        break;
                        
                    case "resultsearch":
                        $controller = new SearchController('resultsearch');
                        echo "Load";
                        break;

                    case "mes-messages":
                        $controller = new MessageController();
                        $controller->getAllConversations($_SESSION["idU"]);
                        $controller->setViewName("messages");
                        $controller->loadView();
                        break;

                    case "nouvelle-conversation":
                        $controller = new MessageController();
                        $controller->newConversation();
                        break;

                    case "nouveau-message":
                        $controller = new MessageController();
                        $controller->newMsg();
                        break;    

                    case preg_match("/conversation.*/", strtolower($root)) ? true : false:// TODO:
                        $urlSplited = explode('/', $_SERVER['REQUEST_URI']) ; //On divise le chemin selon le critère "/"
                        $a = $urlSplited[(count($urlSplited) -1)]; // On accède ensuite à l'id de l'annonce
                        $GLOBALS['lidC'] = (int)$a;

                        
                        $controller = new MessageController();
                        $controller->getListMessByConv($GLOBALS["lidC"]);
                        $controller->setViewName("messages");
                        $controller->loadView();
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