
<!-- ----- debut ControllerStock -->
<?php
require_once '../model/ModelStock.php';

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

}
?>
<!-- ----- fin ControllerStock -->


