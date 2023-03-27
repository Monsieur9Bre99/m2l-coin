<?php
    session_start();
    include_once(str_replace("\Controllers", "",__DIR__)."\\Models\\Model.php");
    class LoginController{

        private $viewName;
        private $parent;

        public function __construct($viewName=NULL) // home
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName; //home
            // Je sais que toujours le dossier qui contiendra les vues et celui Views
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("\Controllers", "",__DIR__)."\\Views\\";
            // Ici je charge la page en question...
            if(! empty($viewName)){
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

        public function checkConnection()
        {
            // Récupérer les infos de connexion...
            
            $email = NULL;
            $pwd = NULL;
            if(isset($_POST))
            {
                $email = trim(htmlentities($_POST['email']));
                $pwd = md5(trim(htmlentities($_POST['pwd'])));  

                // Une fois les données récupées...
                $model = new Model();
                $user = $model->userLogiIn($email, $pwd);
                if(!$user)
                {
                    $_SESSION["message"] = "Login ou mot de passe incorrect";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";

                    header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "connexion"));
                    exit;
                }
                else
                {

                    //echo "Connexion avec succès => Bonjour ".$user['userName'];
                    //setcookie("USER_NOT_FOUND", FALSE, time() + 60);
                    foreach($user as $key => $value)
                    {
                        $_SESSION[$key] = $value;
                    }

                    $_SESSION["message"] = "Bonjour <i style='font-size: 1.3rem'>". $_SESSION["prenom"]. "</i>. Vous êtes connecté(e). Contents de vous revoir 😊 !!" ;
                    $_SESSION["status"] = "success";
                    $_SESSION["icone"] = "fa-check-circle";

                    header(sprintf("Location: %s",$GLOBALS['__HOST__']));
                    exit();
                }
            }
        }

        public function killSession()
        {
            if(isset($_SESSION) && !empty($_SESSION))
            {
                session_unset();
                session_destroy();
            }
            header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], ""));
            exit;
        }

        public function inscriptionUser()
        {
            // Récupérer les infos de connexion...
            // var_dumP($_POST);
            // die();
            if(isset($_POST))
            {
                if ((isset($_POST["nom"])) && (isset($_POST["prenom"])) && (isset($_POST["email"])) && (isset($_POST["tel"])) && (isset($_POST["pwd"])) && (isset($_POST["cpwd"])))
                {
                    if ((trim($_POST["nom"]) != '') && (trim($_POST["prenom"])!= '') && (trim($_POST["email"])!= '') && (trim($_POST["tel"])!= '') && (trim($_POST["pwd"])!= '') && (trim($_POST["cpwd"])!= ''))
                    {
                        if (filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) 
                        {
                            if((trim($_POST["pwd"])) == (trim($_POST["cpwd"])))
                            {
                                $regex = '#^0[6-7]{1}\d{8}$#'; 
                                $tel = '0612345678'; 
                                if(preg_match( $regex, trim($_POST["tel"]))) 
                                { 
                                    $nom = trim(htmlentities($_POST['nom']));
                                    $prenom = trim(htmlentities($_POST['prenom']));
                                    $email = trim(htmlentities($_POST['email']));
                                    $tel = trim(htmlentities($_POST['tel']));
                                    $pwd = md5(trim(htmlentities($_POST['pwd'])));  
                    
                                    $tab = [$nom, $prenom, $email, $tel, $pwd];
                    
                                    // Une fois les données récupées...
                                    $model = new Model();
                                    $user = $model->insertUser($email, $tab);
                    
                                    if($user == FALSE)
                                    {
                                        $_SESSION["message"] = "Erreur lors de l'inscription. Veuillez réessayer !!";
                                        $_SESSION["status"] = "danger";
                                        $_SESSION["icone"] = "fa-exclamation-circle";
                    
                                        header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                                        exit();
                                    }
                                    else if($user == TRUE)
                                    {
                                        $_SESSION["message"] = "Votre compte a été créé avec  succès. Veuillez vous connecter";
                                        $_SESSION["status"] = "success";
                                        $_SESSION["icone"] = "fa-check-circle";
                    
                                        header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "connexion"));
                                        exit();
                                    }
                                    else
                                    {
                                        $_SESSION["message"] = "Cette adresse email est déja utilisée";
                                        $_SESSION["status"] = "danger";
                                        $_SESSION["icone"] = "fa-exclamation-circle";
                    
                                        header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                                        exit();
                                    }   
                                } 
                                else 
                                { 
                                    $_SESSION["message"] = "Format de numéro de téléphone incorrect: Format accepté : 06 05 04 03 02";
                                    $_SESSION["status"] = "danger";
                                    $_SESSION["icone"] = "fa-exclamation-circle";
                
                                    header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                                    exit();
                                }
                            } 
                            else
                            {
                                $_SESSION["message"] = "Les deux mots de passe ne correspondent pas !!";
                                $_SESSION["status"] = "danger";
                                $_SESSION["icone"] = "fa-exclamation-circle";
            
                                header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                                exit();
                            }
                        } 
                        else 
                        {
                            $_SESSION["message"] = "Format d'adresse email incorrect !!";
                            $_SESSION["status"] = "danger";
                            $_SESSION["icone"] = "fa-exclamation-circle";

                            header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                            exit();
                        } 
                    }
                    else
                    {
                        $_SESSION["message"] = "Champ(s) vide(s). Veuillez remplir tous les champs !! ";
                        $_SESSION["status"] = "danger";
                        $_SESSION["icone"] = "fa-exclamation-circle";

                        header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                        exit();
                    }
                }
                else
                {
                    $_SESSION["message"] = "Champ(s) vide(s). Veuillez remplir tous les champs !! ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";

                    header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                    exit();
                }
            }
            else
            {
                $_SESSION["message"] = "Le formulaire n'a pas pu être envoyé !!";
                $_SESSION["status"] = "danger";
                $_SESSION["icone"] = "fa-exclamation-circle";

                header(sprintf("Location: %s%s",$GLOBALS['__HOST__'], "inscription-form"));
                exit();
            }
        }
    }
?>