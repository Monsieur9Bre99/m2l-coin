<?php

include_once(str_replace("\Controllers", "",__DIR__)."\\Models\\Model.php");
    class FavorisController
    {

        private $viewName;
        private $parent;

        public function __construct($viewName=NULL)
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName; 

            // Je sais que toujours le dossier qui contiendra les vues et celui Views
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("\Controllers", "",__DIR__)."\\Views\\";

            // Ici je charge la page en question...

            if(!empty($viewName))
            {
                $this->loadView();
            }
        }
        
        public function loadView()
        {
            // Etant donné que notre header( en tête ) ne changera jamais entre les views alors
            require_once($this->parent."commons\\header.php");
            // Ici la page qui va changer
            require_once($this->parent.$this->viewName.".php");
            // Etant donné que notre footer ( pied ) ne changera jamais entrre les pages alors
            require_once($this->parent."commons\\footer.php");
        }

        public function actionSurFavoris($idU, $idA)
        {
            
            if ((is_numeric($idU)) && (is_numeric($idA)))
            {
                $vraiIdU = $idU / 3645;
                $vraiIdA  = $idA / 6895;

                
                if (($vraiIdU == 0) || ($vraiIdA  == 0)) 
                {
                    $_SESSION["message"] = "Erreur !! Lien vers l'annonce incorrecte ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";
                    header(sprintf("Location: %s",$GLOBALS['__HOST__']));
                    exit();
                } 
                else if((!is_int($vraiIdU)) || (!is_int($vraiIdA )))
                {
                    $_SESSION["message"] = "Erreur !! Lien vers l'annonce incorrecte ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";
                    header(sprintf("Location: %s",$GLOBALS['__HOST__']));
                    exit();
                }
                else
                {
                    $model = new Model();
                    $test = $model->checkAnnonceInUserFavoris($vraiIdU, $vraiIdA );

                    

                    if($test == TRUE)
                    {
                        $action = $model->insertFavoris($vraiIdU, $vraiIdA );

                        //var_dump($action); die();

                        if ($action == TRUE)
                        {
                            $_SESSION["message"] = "Cette annonce a été ajoutée à vos favoris avec succès!! ";
                            $_SESSION["status"] = "success";
                            $_SESSION["icone"] = "fa-check-circle";
                            header(sprintf("Location: %s%s/%s",$GLOBALS['__HOST__'], "detail", ($vraiIdA * 6895)));
                            exit();
                        }
                        else
                        {
                            $_SESSION["message"] = "Une erreur s'est produite lors de l'ajout de cette annonce en favoris !! ";
                            $_SESSION["status"] = "danger";
                            $_SESSION["icone"] = "fa-exclamation-circle";
                            header(sprintf("Location: %s%s/%s",$GLOBALS['__HOST__'], "detail", ($vraiIdA * 6895)));
                            exit();
                        }
                    }
                    elseif($test == FALSE)
                    {
                        $action = $model->deleteFavoris($vraiIdU, $vraiIdA );
                        if ($action == TRUE)
                        {
                            $_SESSION["message"] = "Cette annonce a été supprimée de vos favoris avec succès !! ";
                            $_SESSION["status"] = "success";
                            $_SESSION["icone"] = "fa-check-circle";
                            header(sprintf("Location: %s%s/%s",$GLOBALS['__HOST__'], "detail", ($vraiIdA * 6895)));
                            exit();
                        }
                        else
                        {
                            $_SESSION["message"] = "Une erreur s'est produite lors de la suppression de cette annonce en favoris !! ";
                            $_SESSION["status"] = "danger";
                            $_SESSION["icone"] = "fa-exclamation-circle";
                            header(sprintf("Location: %s%s/%s",$GLOBALS['__HOST__'], "detail", ($vraiIdA * 6895)));
                            exit();
                        }
                    }
                    else 
                    {
                        $_SESSION["message"] = "Une erreur s'est produite lors de la vérification de cette annonce dans la base de  données !! ";
                        $_SESSION["status"] = "danger";
                        $_SESSION["icone"] = "fa-exclamation-circle";
                        header(sprintf("Location: %s",$GLOBALS['__HOST__']));;
                        exit();
                    }
                }
            }
            else
            {
                $_SESSION["message"] = "Erreur : Lien invalide. Impossible d'ajouter l'annonce en favoris !! ";
                $_SESSION["status"] = "danger";
                $_SESSION["icone"] = "fa-exclamation-circle";
                header(sprintf("Location: %s",$GLOBALS['__HOST__']));
                exit();
            }
        }
    }