<?php
    //session_start();
    include_once(str_replace("\Controllers", "",__DIR__)."\\Models\\Model.php");

    class AnnonceController{

        private $viewName; // le nom de la vue
        private $parent;

        public function __construct($viewName=NULL)
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName;
            // Je sais que toujours le dossier qui contiendra les vues et celui Views
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("\Controllers", "",__DIR__)."\\Views\\";

            $model = new Model();
            $GLOBALS["locations"] = $model->getAllLocations();
            $GLOBALS["categories"] = $model->getAllCategories();
          
            if($viewName != NULL){
                $this->loadView();
            }

        }
        
        public function loadView(){
            // Etant donné que notre header( en tête ) ne changera jamais entre les views alors
            require_once($this->parent."commons\\header.php");
            // Ici la page qui va changer
            require_once($this->parent.$this->viewName.".php");
            // Etant donné que notre footer ( pied ) ne changera jamais entrre les pages alors
            require_once($this->parent."commons\\footer.php");
        }

        public function nouvelleAnnonce()
        {
            if(isset($_POST))
            {
                // Récupérer les infos de connexion...
                ///var_dump($_POST);
                //die();
                
                if ((isset($_POST["titre"])) && (isset($_POST["prix"])) && (isset($_POST["descrip"])) && (isset($_POST["categorie"])) && (isset($_POST["localisation"])) && (isset($_FILES["image"]) && !$_FILES["image"]["error"]))
                {
                    if ((trim($_POST["titre"]) != '') && (trim($_POST["prix"]) != '') && (trim($_POST["descrip"]) != ''))
                    {
                        if (trim($_POST["prix"]) > 0) 
                        {
                            if (trim($_POST["idUser"]) != "") 
                            {
                                if ((isset($_FILES["image"]) && !$_FILES["image"]["error"]))
                                {
                                    $extensions = array("jpg", "png", "gif", "jpeg", "PNG");
                                    
                                    $fileInfo = pathinfo($_FILES["image"]["name"]);
    
                                    //Si la taille de l"image est <= 2 Mo
                                    if ($_FILES["image"]["size"] <= 2000000) 
                                    {
                                        //Si l"image a la bonne extension
                                        if (in_array($fileInfo["extension"], $extensions)) 
                                        {
    
                                            //On peut commencer le traitement
                                            $titre =        trim(htmlentities($_POST["titre"]));
                                            $localisation = trim(htmlentities($_POST["localisation"]));
                                            $categorie =    (int)trim(htmlentities($_POST["categorie"]));
                                            $prix =         (int)trim(htmlentities($_POST["prix"]));
                                            $description =  trim(htmlentities($_POST["descrip"]));
                                            $idUtilisateur = (int)$_POST["idUser"];
    
                                            $chemin = "img/annonce/".$titre.".png";
    
                                            $dos= str_replace("\Controllers", "",__DIR__)."\\Template\\real-estate-html-template\\img\\annonce\\".$titre.".png";
                                            move_uploaded_file($_FILES["image"]["tmp_name"], $dos);
                                            //echo "Le fichier a été envoyé sur le serveur";
    
                                            $tab = [$titre, $prix, $description, $chemin, $categorie, $localisation, $idUtilisateur];
                                            
                                            $model = new Model();
                                            $result = $model->insertAnnonce($tab);
    
                                            if($result)
                                            {
                                                $_SESSION["message"] = 'Votre annonce a été ajoutée avec succès !! Veuillez cliquer sur l\'onglet <b><i>"Mes annonces"</i></b> pour la consulter';
                                                $_SESSION["status"] = "success";
                                                $_SESSION["icone"] = "fa-check-circle";
                                                header(sprintf("Location: %s",$GLOBALS['__HOST__']));
                                                exit();
                                            }
                                            else
                                            {
                                                $_SESSION["message"] = "Une erreur s'est produite lors de l'enregistrement !! ";
                                                $_SESSION["status"] = "danger";
                                                $_SESSION["icone"] = "fa-exclamation-circle";
                            
                                                header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                                                exit();
                                            }
                                        } 
                                        else 
                                        {
                                            $_SESSION["message"] = "Ce type de fichier n'est pas autorisé !!";
                                            $_SESSION["status"] = "danger";
                                            $_SESSION["icone"] = "fa-exclamation-circle";
                        
                                            header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                                            exit();
                                        }
                                    }
                                    else 
                                    {
                                        $_SESSION["message"] = "Taille du fichier trop grande !!";
                                        $_SESSION["status"] = "danger";
                                        $_SESSION["icone"] = "fa-exclamation-circle";
                    
                                        header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                                        exit();
                                    }
                                } 
                                else 
                                {
                                    $_SESSION["message"] = "Une erreur est survenue lors de l'envoi du fichier";
                                    $_SESSION["status"] = "danger";
                                    $_SESSION["icone"] = "fa-exclamation-circle";
                
                                    header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                                    exit();
                                }
                            }
                            else
                            {
                                $_SESSION["message"] = "Veuillez vous connecter pour ajouter une annonce";
                                $_SESSION["status"] = "danger";
                                $_SESSION["icone"] = "fa-exclamation-circle";
            
                                header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "connexion"));
                                exit();
                            }
                               
                        } 
                        else if(trim($_POST["prix"]) > 1000)
                        {
                            $_SESSION["message"] = "La limite maximale est 1 000 €";
                            $_SESSION["status"] = "danger";
                            $_SESSION["icone"] = "fa-exclamation-circle";

                            header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                            exit();
                        } 
                        else 
                        {
                            $_SESSION["message"] = "Veuillez entrer un prix valide !!";
                            $_SESSION["status"] = "danger";
                            $_SESSION["icone"] = "fa-exclamation-circle";

                            header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                            exit();
                        } 
                    }
                    else
                    {
                        $_SESSION["message"] = "Champ(s) vide(s). Veuillez remplir tous les champs !! ";
                        $_SESSION["status"] = "danger";
                        $_SESSION["icone"] = "fa-exclamation-circle";

                        header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                        exit();
                    }
                }
                else
                {
                    $_SESSION["message"] = "Champ(s) vide(s). Veuillez remplir tous les champs !! ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";

                    header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                    exit();
                }
            }
            else
            {
                $_SESSION["message"] = "Le formulaire n'a pas pu être envoyé !!";
                $_SESSION["status"] = "danger";
                $_SESSION["icone"] = "fa-exclamation-circle";

                header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "deposer-une-annonce"));
                exit();
            }
        } 
        

        public function getUserAnnonces()
        {
            if(isset($_SESSION) && !empty($_SESSION)){
                $userID = $_SESSION['idU'];
                $model = new Model();
                $GLOBALS['userAnnonces'] = $model->getUserAnnonces($userID);

                
                $this->viewName = 'mes-annonces';
                $this->loadView();
            }
        }

        public function mesFavoris()
        {
            if(isset($_SESSION) && !empty($_SESSION))
            {
                $model = new Model();
                $GLOBALS['MESFAVORIS'] = $model->getFavoris($_SESSION['idU']);

                $this->viewName = 'favoris';
                $this->loadView();
            }
        }
    }

?>