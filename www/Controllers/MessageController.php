<?php
    //session_start();
    include_once(str_replace("/Controllers", "",__DIR__)."//Models//Model.php");

    class MessageController
    {
        private $viewName; // le nom de la vue
        private $parent;

        public function __construct($viewName=NULL)
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName;
            // Je sais que toujours le dossier qui contiendra les vues et celui Views
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("/Controllers", "",__DIR__)."//Views//";
          
            if($viewName != NULL){
                $this->loadView();
            }

        }
        
        public function loadView()
        {
            // Etant donné que notre header( en tête ) ne changera jamais entre les views alors
            require_once($this->parent."commons//header.php");
            // Ici la page qui va changer
            require_once($this->parent.$this->viewName.".php");
            // Etant donné que notre footer ( pied ) ne changera jamais entrre les pages alors
            require_once($this->parent."commons//footer.php");
        }

        public function setViewName($name)
        {
            $this->viewName = $name;
        }

        public function newConversation()
        {
            //var_dump($_POST) ; die();
            if (isset($_POST["message"])) 
            {
                if (!empty($_POST["message"])) 
                {
                    $contenu = trim(htmlentities($_POST["message"]));
                    $idEnv = (int)$_SESSION["idU"];
                    $idRec = (int)$_POST["idReceveur"];
                    $idAnn = (int)$_POST["idAnn"];

                    $tabC = [$idAnn, $idEnv, $idRec];
                    $model = new Model();
                    $resultC = $model->insertNewConv($tabC);
                    //var_dump($model->getLastIdConv());die();
                    if ($resultC) 
                    {
                        $lastIdConv = $model->getLastIdConv();
                        if(!$lastIdConv)
                        {
                            $_SESSION["message"] = "Une erreur inattendue est survenue. Veuilllez réessayer !! ";
                            $_SESSION["status"] = "danger";
                            $_SESSION["icone"] = "fa-exclamation-circle";
                            header(sprintf("Location: %sdetail/%s",$GLOBALS['__HOST__'],($_POST["idAnn"] * 6895)));
                        }
                        else
                        {
                            $tabM =[$idEnv, $idRec, $lastIdConv, $contenu];
                            $resultM = $model->insertNewMsg($tabM);

                            if ($resultM) 
                            {
                                $_SESSION["message"] = "Votre messsage a été envoyé avec succès !! ";
                                $_SESSION["status"] = "success";
                                $_SESSION["icone"] = "fa-check-circle";
                                header(sprintf("Location: %sdetail/%s",$GLOBALS['__HOST__'],($_POST["idAnn"] * 6895)));
                            } 
                            else 
                            {
                                $_SESSION["message"] = "Une erreur inattendue est survenue lors de l'ajout du message. Veuilllez réessayer !! ";
                                $_SESSION["status"] = "danger";
                                $_SESSION["icone"] = "fa-exclamation-circle";
                                header(sprintf("Location: %sdetail/%s",$GLOBALS['__HOST__'],($_POST["idAnn"] * 6895)));
                            }
                            
                        }
                    } 
                    else 
                    {
                        $_SESSION["message"] = "Erreur lors de la création de la conversation. Veuilllez réessayer !! ";
                        $_SESSION["status"] = "danger";
                        $_SESSION["icone"] = "fa-exclamation-circle";
                        header(sprintf("Location: %sdetail/%s",$GLOBALS['__HOST__'],($_POST["idAnn"] * 6895)));
                    }
                }
                else 
                {
                    $_SESSION["message"] = "Veuillez entrer un messsage valide!! ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";
                    header(sprintf("Location: %sdetail/%s",$GLOBALS['__HOST__'],($_POST["idAnn"] * 6895)));
                }
            } 
            else 
            {
                $_SESSION["message"] = "Veuillez entrer un messsage!! ";
                $_SESSION["status"] = "danger";
                $_SESSION["icone"] = "fa-exclamation-circle";
                header(sprintf("Location: %sdetail/%s",$GLOBALS['__HOST__'],($_POST["idAnn"] * 6895)));
            }
            
        }

        public function getAllConversations()
        {
            $id = $_SESSION["idU"];
            $model = new Model();
            $GLOBALS["listConv"] = $result = $model->getListConv($id);
            
            if ($result) 
            {
                $maTabMes = array();
                $maTabUtil = array();

                foreach ($result as $uneConv) 
                {
                    $result2 = $model->getLastMsg($uneConv["idConversation"]);
                    $maTabMes[$uneConv["idConversation"]] = $result2;

                    $vraiIdC = $uneConv["idConversation"];
                    $result3 = $model->getInfosConv($vraiIdC);

                    if ($result3["idQ"] == $_SESSION["idU"]) 
                    {
                        $dest = $result3["idR"];
                    }
                    else if ($result3["idR"] == $_SESSION["idU"])
                    {
                        $dest = $result3["idQ"];
                    }

                    $result4 = $model->getUserById($dest);

                    $maTabUtil[$uneConv["idConversation"]] = $result4;
                }
                $GLOBALS["maTabMes"] = $maTabMes;
                $GLOBALS["maTabUtil"] = $maTabUtil;

            }
            else 
            {
                $_SESSION["message"] = "Vous n'avez aucune conversation !! ";
                $_SESSION["status"] = "info";
                $_SESSION["icone"] = "fa-info-circle";
                header(sprintf("Location: %smes-messages",$GLOBALS['__HOST__']));
                exit();
            } 
                    
        }

        public function getListMessByConv(int $idC)
        {
            if (is_numeric($idC)) 
            {
                $vraiIdC = $idC / 7649 ;

                if ($vraiIdC == 0) 
                {
                    $_SESSION["message"] = "Impossible d'afficher une conversation qui n'existe pas !! ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";
                    header(sprintf("Location: %smes-messages",$GLOBALS['__HOST__']));
                    exit();
                } 
                else if(!is_int($vraiIdC))
                {
                    $_SESSION["message"] = "Impossible d'afficher une conversation qui n'existe pas !! ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";
                    header(sprintf("Location: %smes-messages",$GLOBALS['__HOST__']));
                    exit(); 
                }
                else
                {
                    $id = $_SESSION["idU"];
                    $model = new Model();
                    $GLOBALS["listConv"] = $result = $model->getListConv($id);

                    
                    
                    if ($result) 
                    {
                        $maTabMes = array();
                        $maTabUtil = array();

                        foreach ($result as $uneConv) 
                        {
                            $result2 = $model->getLastMsg($uneConv["idConversation"]);
                            $maTabMes[$uneConv["idConversation"]] = $result2;

                            $vraiIdCTraitement = $uneConv["idConversation"];
                            $result3 = $model->getInfosConv($vraiIdCTraitement);

                            if ($result3["idQ"] == $_SESSION["idU"]) 
                            {
                                $dest = $result3["idR"];
                            }
                            else if ($result3["idR"] == $_SESSION["idU"])
                            {
                                $dest = $result3["idQ"];
                            }

                            $result4 = $model->getUserById($dest);

                            $maTabUtil[$uneConv["idConversation"]] = $result4;
                        }
                        //var_dump($maTabMes, $maTabUtil ); die();
                        $GLOBALS["maTabMes"] = $maTabMes;
                        $GLOBALS["maTabUtil"] = $maTabUtil;

                        $result4 = $model->getMsgConv($vraiIdC);

                        //var_dump($result4); die();

                        //var_dump($result4); die();

                        if ($result4) 
                        {
                            $tabInfoSender= [];

                            foreach ($result4 as $leMess) 
                            {
                                $result5 = $model->getUserById($leMess["idSender"]);
                                $tabInfoSender[$leMess["idM"]] = $result5;
                            }

                            $GLOBALS["listMes"] = $result4; //Liste des messages de la conversation
                            $GLOBALS["currentIdConv"] = $vraiIdC; //l'id de la conversation courante

                            $result6 = $model->getInfosConv($vraiIdC);

                            if ($result6["idQ"] == $_SESSION["idU"]) 
                            {
                                $GLOBALS["destinataire"] = $result6["idR"];
                            }
                            else if ($result6["idR"] == $_SESSION["idU"])
                            {
                                $GLOBALS["destinataire"] = $result6["idQ"];
                            }

                            $GLOBALS["tabInfoSender"] = $tabInfoSender;

                            //Gestion de la partie annonce
                            $idAnn = $result6["idAnnonce"];

                            $result7 = $model->getAnnonceById($idAnn);
                            if ($result7) 
                            {
                                $GLOBALS["infoAnn"] = $result7;
                            } 
                            else 
                            {
                                $GLOBALS["infoAnn"] = NULL;
                            }
                            
    
                        }
                        else
                        {
                            $GLOBALS["listMes"] = NULL;
                        }

                        $this->viewName = "messages";
                        $this->loadView();
                    }
                    else 
                    {
                        $_SESSION["message"] = "Vous n'avez aucune conversation !! ";
                        $_SESSION["status"] = "info";
                        $_SESSION["icone"] = "fa-info-circle";
                        header(sprintf("Location: %smes-messages",$GLOBALS['__HOST__']));
                        exit();
                    } 
                }
            }
        }
            
        public function newMsg()
        {
            if (isset($_POST)) 
            {
                $idC = (int)$_POST["idConv"];

                if((isset($_POST["message"])) && (trim($_POST["message"] != "")))
                {
                    $message = trim(htmlspecialchars($_POST["message"]));
                    $destinataire = (int)$_POST["destinataire"];
                    $expediteur = $_SESSION["idU"]; 

                    $array = [$expediteur, $destinataire, $idC, $message];

                    $model = new Model();

                    $result = $model->insertNewMsg($array);
                    
                    if ($result) 
                    {
                        $_SESSION["message"] = "Message envoyé avec succès !! ";
                        $_SESSION["status"] = "success";
                        $_SESSION["icone"] = "fa-check-circle";
                        header(sprintf("Location: %sconversation/%s",$GLOBALS['__HOST__'], ($idC * 7649)));
                        exit();
                    } 
                    else 
                    {
                        $_SESSION["message"] = "Une erreur inattendue est survenue lors le l'envoi du message. Veuillez réessayer !! ";
                        $_SESSION["status"] = "danger";
                        $_SESSION["icone"] = "fa-exclamation-circle";
                        header(sprintf("Location: %sconversation/%s",$GLOBALS['__HOST__'], ($idC * 7649)));
                        exit();
                    }
                    
                }
                else 
                {
                    $_SESSION["message"] = "Veuillez insérer un message !! ";
                    $_SESSION["status"] = "danger";
                    $_SESSION["icone"] = "fa-exclamation-circle";
                    header(sprintf("Location: %sconversation/%s",$GLOBALS['__HOST__'], ($idC * 7649)));
                    exit();
                }
            }
        }
    }