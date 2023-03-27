<?php

    class UpdateController
    {

        private $viewName;
        private $parent;
        private $valCat;
        private $valLoc;
        
        public function __construct($viewName)
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName;

            // Je sais que toujours le dossier qui contiendra les vues et celui Views
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("\Controllers", "",__DIR__)."\\Views\\";
            
            //Exécuter les fonctions nécessaires
            $GLOBALS["annonce"] = $this->getAnnonceById($GLOBALS["id"]);
            $GLOBALS["selectedLoc"] = $this->selection("localisation", $this->valLoc, $this->getLocalisations());
            $GLOBALS["selectedCat"] = $this->selection("categorie", $this->valCat, $this->getCategs());

            // Ici je charge la page en question...
            $this->loadView();

        }
        
        public function loadView() : void
        {
            // Etant donné que notre header( en tête ) ne changera jamais entre les views alors
            require_once($this->parent."commons\\header.php");
            // Ici la page qui va changer
            require_once($this->parent.$this->viewName.".php");
            // Etant donné que notre footer ( pied ) ne changera jamais entrre les pages alors
            require_once($this->parent."commons\\footer.php");
        }

        public function getCategs() : array
        {
            $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
            $req = $bdd->query("SELECT * FROM categorie");
            $categories = $req->fetchAll(PDO::FETCH_ASSOC);
            $GLOBALS["lesCategories"] = $categories;
            return $categories;
        }

        // public function getCategName(): string
        // {
        //     $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
        //     $req = $bdd->prepare("SELECT libelle FROM categorie WHERE idCategorie = ?");
        //     $req->execute(array($this->valCat));
        //     $categName = $req->fetch(PDO::FETCH_ASSOC);
        //     $GLOBALS["laCategorie"] = $categName["libelle"];
        //     return $categName["libelle"];
        // }

        public function getLocalisations() : array
        {
            $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
            $req = $bdd->query("SELECT * FROM localisation");
            $localisations = $req->fetchAll(PDO::FETCH_ASSOC);
            $GLOBALS["lesLocalisations"] = $localisations;
            return $localisations;
        }

        // public function getLocalisationName() : string
        // {
        //     $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
        //     $req = $bdd->prepare("SELECT dep FROM localisation WHERE codeDep = ?");
        //     $req->execute(array($this->valLoc));
        //     $locName = $req->fetch(PDO::FETCH_ASSOC);
        //     $GLOBALS["laLocalisation"] = $locName["dep"];
        //     return $locName["dep"];
        // }    
        
        public function getAnnonceById($id) : array
        {
            $id_to_update = (int)htmlentities($id);
            
            $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
            $query = $bdd->prepare("SELECT * FROM annonce WHERE idAnnonce = ?");
            $query->execute(array($id_to_update));
            $lAnnonce = $query->fetch(PDO::FETCH_ASSOC);

            $this->valLoc = $lAnnonce["codeLocalisation"];
            $this->valCat = $lAnnonce["idCategorie"];

            return $lAnnonce; 
        }

        function selection(string $name, $valueId, array $options) : string
        {
            $html_options = []; 

            foreach ($options as $r => $cat) 
            {
                $attribut = $cat[array_keys($cat)[0]] == $valueId ? " selected" : " ";
                $html_options[] = "<option value= '".$cat[array_keys($cat)[0]]."' ".$attribut.">".$cat[array_keys($cat)[1]]."</option><br>";
            }
            return '<select id="floatingSelect" class="form-control" name="'.$name.'">'.implode($html_options).'</select>';
        }
  
    }

?>