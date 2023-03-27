<?php
    include_once(str_replace("\Controllers", "",__DIR__)."\\Models\\Model.php");
    class LandingController{

        private $viewName; // le nom de la vue
        private $parent;

        public function __construct($viewName)
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName;
            // Je sais que toujours le dossier qui contiendra les vues et celui Views
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("\Controllers", "",__DIR__)."\\Views\\";
            // Ici je charge la page en question...
            $modele = new Model();
            $GLOBALS["locations"] = $modele->getAllLocations();
            $GLOBALS["categories"] = $modele->getAllCategories();
            $GLOBALS["TopCategory"] = $modele->getTopCategory();
            $GLOBALS["lesAnnonces"] = $modele->getAllAnnonces();
            $this->loadView();

        }
        
        public function loadView(){
            // Etant donné que notre header( en tête ) ne changera jamais entre les views alors
            require_once($this->parent."commons\\header.php");
            // Ici la page qui va changer
            require_once($this->parent.$this->viewName.".php");
            // Etant donné que notre footer ( pied ) ne changera jamais entrre les pages alors
            require_once($this->parent."commons\\footer.php");
        }
    }

?>