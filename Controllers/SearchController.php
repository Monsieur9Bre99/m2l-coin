<?php

    include_once(str_replace("\Controllers", "",__DIR__)."\\Models\\Model.php");
    class SearchController{

        private $viewName; // le nom de la vue
        private $parent;

        public function __construct($viewName=NULL)
        {
            // Je récupére le nom de la vue que je dois charger...
            $this->viewName = $viewName;
            // Je sais que toujours le dossier qui contiendra les vues et celui Viewsnn
            // $this->parent = construit le chemin en auto vers le dossier contenant les views...
            $this->parent = str_replace("\Controllers", "",__DIR__)."\\Views\\";

            $modele = new Model();
            $GLOBALS["locations"] = $modele->getAllLocations();
            $GLOBALS["categories"] = $modele->getAllCategories();
            $GLOBALS["lesAnnonces"] = $modele->getAllAnnonces();
          
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

        public function getResultSearch()
        {

            if(isset($_POST) && !empty($_POST))
            {
                // Form submitted as well
                $category = isset($_POST['category']) ? $_POST['category'] : "";
                $critere = "%".trim(htmlentities($_POST['what']))."%";
                $location = isset($_POST['location']) ? $_POST['location'] : "";

                // Call model to check if there is some similar post's

                $model = new Model();
                $GLOBALS['resultSearch'] = $res = $model->getAnnoncesCritaria($critere, $category, $location);
                var_dump($res);

                $this->viewName = 'resultsearch';
                $this->loadView();
            }
        }

        
    }

?>