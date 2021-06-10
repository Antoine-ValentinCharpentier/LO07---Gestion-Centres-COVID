
<!-- ----- debut ControllerStock -->
<?php
require_once '../model/ModelStock.php';
require_once '../model/ModelVaccin.php';

class ControllerStock {

    // --- Liste des centres avec le nombre de doses de chaque vaccin
    public static function stockCentre() {
        $results = ModelStock::getStockUnitaireCentre();

        $title = "Liste des centres avec le nombre de doses de chaque vaccin";

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/stock/viewStockUnitaireCentre.php';

        require ($vue);
    }


    //somme des doses de chaque vaccin pour tous les centres
    public static function stockGlobal() {
        $results = ModelStock::getStockGlobalCentre();

        $title = "Nombre global de doses par centres";

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/stock/viewStockGlobalCentre.php';

        require ($vue);
    }

    //Formulaire afin d'insérer des doses supplémentaires de chaque vaccin pour chaque centre
    public static function stockInsertDose() {
        //on récupère l'enssemble des vaccins pour pouvoir leur demander la quantité
        $listeVaccin = ModelVaccin::getAll();

        //on récupère la liste des centres
        $listeCentre = ModelCentre::getAll();

        //on définit le titre qui sera affiché dans la page
        $title = "Ajouter de nouvelle doses de vaccins à un centre";

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/stock/viewInsertDose.php';
        require ($vue);
    }

    //Ajoute dans la base de données les doses, et affiche les nouvelle quantité de doses dans ce centre
    public static function stockInsertedDose() {
        $results = 0;
        foreach ($_GET as $idVaccin => $doses) {
            //on regarde que les vaccins,s'il y a eu un problème lors de l'insertion, on n'en insère plus
            if($idVaccin != "action" && $idVaccin != "idCentre" && $results != -1){
                $results = ModelStock::ajoutNouvelleDoses(
                    htmlspecialchars($_GET['idCentre']), htmlspecialchars($idVaccin), htmlspecialchars($doses)
                );
            }
        }
        
        $results = ModelStock::getStockUnitaireCentreAvecIdParticulier(htmlspecialchars($_GET['idCentre']));

        //on définit le titre qui sera affiché dans la page
        if($results == -1){
            $title = "Problème lors de l'insertion des nouvelles doses.";
        }else{
            $title = "Les nouvelles valeurs des doses pour ce centre sont :";
        }
        
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/stock/viewStockUnitaireCentre.php';
        require ($vue);
    }


}
?>
<!-- ----- fin ControllerStock -->


