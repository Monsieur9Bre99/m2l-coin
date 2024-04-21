<?php
    class Model
    {
       

        private $connection = NULL; // Ce champ la servira pour savoir si nous avons pu se connecter sur la base de données ou pas...
        private $DSN = "mysql:host=localhost;dbname=m2l-coin";
        private $USER = "root";
        private $PWD = "";
        // By default
        private $OPTIONS = array (
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        );

        // Connexion vers la base de données... cette fonction devrai figurée dans toutes les fonctions qui vont suivre...
        private function connectToBDD()
        {
            try
            {
                // On tente d'ouvrir une connexion vers la base de données MYSQL...
                $this->connection = new PDO($this->DSN, $this->USER, $this->PWD, $this->OPTIONS);
                
            }
            catch(PDOException $e)
            {
                // echo "Echec de connexion !";
                return false;
            }
        }   
//-------------------------------------------------------------------------------------------------------
        // Récupérer toutes les localisations depuis la base de données...
        public function getAllLocations()
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL){
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `localisation`";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }

        // Récupérer toutes les catégories depuis la base de données...
        public function getAllCategories()
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL){
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `categorie`";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet)){
                    return $resultSet;
                }
                return NULL;
            }
        }

        // Récupérer toutes les top catégories depuis la base de données...
        public function getTopCategory()
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL){
                // Connexion vers la base de données OK !
                $queryString = "SELECT c.libelle, CASE WHEN COUNT(a.idCategorie) = 0 THEN 0 ELSE COUNT(a.idCategorie) END AS ArticleParCat
                FROM `annonce` a
                INNER JOIN `categorie` c
                ON a.idCategorie = c.idCategorie
                GROUP BY c.libelle
                ORDER BY ArticleParCat DESC";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet)){
                    return $resultSet;
                }
                return NULL;
            }
        }
//-------------------------------------------------------------------------------------------------------

        // Check si un utilisateur existe (a un compte)
        public function userLogiIn($email, $pwd)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM users WHERE adresseEmail=:email AND mdp=:pwd";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("email"=>$email, "pwd"=>$pwd));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }

        //Inscription d'un nouvel utilisateur
        public function insertUser($param, $array) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                $statement = $this->connection->prepare("SELECT * FROM users WHERE adresseEmail = :email"); //récupère les infos de l'utiisateur qui a créée un compte avec cette adresse mail pour vérifier si elle est dejà utilisée ou non
                $statement->bindValue(':email', $param, PDO::PARAM_STR);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);

                if(!$result)
                {
                    $queryString = "INSERT INTO users(nom,prenom,adresseEmail,telephone,mdp) VALUES (?,?,?,?,?)";
                    $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $resultSet = $queryPrepared->execute($array);
                    
                    if(!$resultSet)
                    {
                        return FALSE;
                    }
                    return TRUE;
                }
                else 
                {
                    return "Ce mail est déja utilisé";
                }
                
            }
        }

        //Vérification de la conformité de l'ancien mot de passe
        public function checkOldMdp($idUtilisateur) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                
                $queryString = "SELECT mdp FROM users WHERE idU = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idUtilisateur));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                
                if(!$resultSet)
                {
                    return FALSE;
                }
                return $resultSet;
            }
        }

        //Modification du mot de passe
        public function updateMdp($motDePasse, $idUtilisateur) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                
                $queryString = "UPDATE `users` SET mdp = :motDp WHERE idU = :id";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute(["motDp"=>$motDePasse, "id"=>$idUtilisateur]);
                
                if(!$resultSet)
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        //Modification des informations d'un utilisateur
        public function updateUserInfos($array) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                
                $queryString = "UPDATE `users` SET  nom = ?,
                                                    prenom = ?,
                                                    adresseEmail = ?,
                                                    telephone = ?  WHERE idU = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute($array);
                
                if(!$resultSet)
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        //Récupérer un utilisateur à partir de son identifiant
        public function getUserById($idUtilisateur)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL){
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `users` WHERE idU = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idUtilisateur));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }

//----------------ANNONCES-------------ANNONCES------------------ANNONCES-------------

        //Inscription d'une nouvelle annonce
        public function insertAnnonce($array) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                
                $queryString = "INSERT INTO `annonce`(titre,prix,description,photo,idCategorie,codeLocalisation,idUser) VALUES (?,?,?,?,?,?,?)";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute($array);
                
                if(!$resultSet)
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        // Récupérations des annonces d'un  utilisateur donné
        public function getUserAnnonces($userID){
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL){
                // Connexion vers la base de données OK !
                $queryString = "SELECT a.*, l.dep, c.libelle FROM annonce a 
                                INNER JOIN users u ON a.IdUser = u.idU 
                                INNER JOIN localisation l ON l.codeDep = a.codeLocalisation 
                                INNER JOIN categorie c ON c.idCategorie = a.idCategorie 
                                WHERE a.IdUser = :userID ORDER BY dateAjout DESC";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("userID"=>$userID));
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }

        //Récupération de toutes les annonces
        public function getAllAnnonces()
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM annonce ORDER BY dateAjout DESC";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }

        //Récupération d'une annonce à partir de la base de donnée
        public function getAnnonceById($idAnnonce)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT a.*, u.nom as nomProprietaire, u.prenom as prenomProprietaire
                                FROM annonce a INNER JOIN users u
                                ON a.idUser = u.idU 
                                WHERE a.idAnnonce = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idAnnonce));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }

        //Fonction en stand by
        public function updateAnnonceImg($array) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                
                $queryString = "UPDATE `annonce` SET  photo = ?  WHERE idAnnonce = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute($array);
                
                if(!$resultSet)
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        //Modification des informations d'une annonce
        public function updateAnnonce($array) 
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                $queryString = "UPDATE `annonce` SET    
                        titre = ?,
                        prix = ?,
                        description = ?,
                        idCategorie = ?,
                        codeLocalisation = ?  WHERE idAnnonce = ?";
                
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute($array);
                
                if(!$resultSet)
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        //Suppression  d'une annonce
        public function deleteAnn($lid)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "DELETE FROM `annonce` WHERE idAnnonce = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute(array($lid));
               
                if(!($resultSet))
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        // Récupération des favoris d'un utilisateur
        public function getFavoris($userID)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT  a.*, l.dep
                FROM favoris f
                INNER JOIN annonce a
                ON a.idAnnonce = f.idA
                INNER JOIN localisation l ON l.codeDep = a.codeLocalisation
                WHERE f.idUtilisateur = :userID";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array("userID"=>$userID));
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return NULL;
            }
        }
        
        //Récupère des annonces selon des critères
        public function getAnnoncesCritaria($critere, $cat, $loc)
        {
            // connect to BDD
            $this->connectToBDD();
            
            if($this->connection != NULL)
            {
                $queryString = "SELECT *
                FROM annonce AS a
                INNER JOIN localisation as l
                ON a.codeLocalisation = l.codeDep
                INNER JOIN categorie as c
                ON a.idCategorie = c.idCategorie
                WHERE lower(a.titre) LIKE ?".
                ($cat === '' ? " " : " AND c.idCategorie = ?").
                ($loc === '' ? " " : " AND l.codeDep = ?");

                
                $tab = [$critere];
                if ($cat !== '') 
                {
                    $tab[] = $cat;
                }
                if ($loc !== '') 
                {
                    $tab[] = $loc;
                }

                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute($tab);
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


                if(!empty($resultSet))
                {
                    return $resultSet;
                }
                return array();
            }
            return NULL;
        }

        //Selectionner une conversation à partir de l'utilisateur et l'annonce
        public function getConvId($idS, $idA)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `conversation` where idQ = ? and idAnnonce = ?";             
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idS, $idA));
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($resultSet))
                {
                    if ($resultSet->rowCount() == 0) 
                    {
                        return 0;
                    }
                    return $resultSet;
                }
                return NULL;
            }
        } 
        
        //Vérifie si une annonce a déjà été ajoutée en favoris par un utilisateur
        public function checkAnnonceInUserFavoris($idU, $idA)
        {
            
            // var_dump($idU); 
            // var_dump($idA);
            // die();
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `favoris` WHERE idUtilisateur = ? AND idA = ?";    
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idU, $idA));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                if($resultSet != FALSE)
                {
                    return FALSE;
                }
                return TRUE;
            }
        }

        //Insertion d'une annonce en favoris
        public function insertFavoris($idU, $idA)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "INSERT INTO `favoris`(idUtilisateur, idA) VALUES (?, ?)";             
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute(array($idU, $idA));
                 
                if($resultSet)
                {
                    return TRUE;
                }
                return FALSE;
            }
        }

        //Suppression d'une annonce en favoris
        public function deleteFavoris($idU, $idA)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "DELETE FROM `favoris` WHERE idUtilisateur = ? AND idA = ?";             
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute(array($idU, $idA));
                 
                if($resultSet)
                {
                    return TRUE;
                }
                return FALSE;
            }
        }

        //Récupération des annonces en favoris d'un utilisateur
        public function getUserFavoris($idU)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `favoris` WHERE idUtilisateur = ?";             
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idU));
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                if(count($resultSet) != 0)
                {
                    $tableau = [];
                    foreach ($resultSet as $key => $value) 
                    {
                        $tableau[] = $this->getAnnonceById($value["idA"]);
                    }
                    return $tableau;
                }
                return FALSE;
            }
        }

        //----------------MESSAGES-------------MESSAGES------------------MESSAGES-------------
        //Insérer un nouveau message
        public function insertNewMsg(array $array)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "INSERT INTO `message` (idSender,idReceiver, idC,contenu) VALUES (?,?,?,?)"; 
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute($array);

                if($resultSet)
                {
                    return TRUE;
                }
                return FALSE;
                
            }
        }

        //Insérer une nouvelle conversation
        public function insertNewConv(array $array)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "INSERT INTO `conversation` (idAnnonce, idQ, idR) VALUES (?,?,?)";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $resultSet = $queryPrepared->execute($array);

                if($resultSet)
                {
                    return TRUE;
                }
                return FALSE;
                
            }
        }

        //Obtenir l'id de la dernière conversation enregistrée
        public function getLastIdConv()
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT idConversation FROM `conversation` ORDER BY createdAt DESC LIMIT 1"; 
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute();
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);

                if($resultSet)
                {
                    return $resultSet["idConversation"];
                }
                return FALSE;   
            }
        }
        //Récupérer la liste des conversations 
        public function getListConv(int $idU)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `conversation` WHERE idQ = ? OR idR = ? ORDER BY createdAt DESC"; 
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idU, $idU));
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                 
                if($resultSet)
                {
                    return $resultSet;
                }
                return FALSE;
            }
        }

        //Récupérer la liste des messages d'une conversation
        public function getMsgConv(int $idC)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `message` WHERE idC = ? ORDER BY dateEnvoi ASC";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idC));
                $resultSet = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
                 
                if($resultSet)
                {
                    return $resultSet;
                }
                return FALSE;
            }
        }

        //Récupérer le dernier message d'une conversation
        public function getLastMsg(int $idC)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `message` WHERE idC = ? ORDER BY dateEnvoi DESC LIMIT 1";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idC));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                 
                if($resultSet)
                {
                    return $resultSet;
                }
                return FALSE;
            }
        }

        //Récupérer les infos d'une conversation
        public function getInfosConv(int $idC)
        {
            // J'ouvre la connexion vers ma base de données...
            $this->connectToBDD();
            if($this->connection != NULL)
            {
                // Connexion vers la base de données OK !
                $queryString = "SELECT * FROM `conversation` WHERE idConversation = ?";
                $queryPrepared = $this->connection->prepare($queryString, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $queryPrepared->execute(array($idC));
                $resultSet = $queryPrepared->fetch(PDO::FETCH_ASSOC);
                 
                if($resultSet)
                {
                    return $resultSet;
                }
                return FALSE;
            }
        }

    }

    
