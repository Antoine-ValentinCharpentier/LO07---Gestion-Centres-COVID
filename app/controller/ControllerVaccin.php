
<!-- ----- debut ControllerVaccin -->
<?php
require_once '../model/ModelVaccin.php';

class ControllerVaccin {
  
  // --- Liste des vaccins
  public static function vaccinReadAll() {
    $results = ModelVaccin::getAll();

    // ----- Construction chemin de la vue
    include 'config.php';
    $vue = $root . '/app/view/vaccin/viewAll.php';
    if (DEBUG) echo ("ControllerVaccin : vaccinReadAll : vue = $vue");
    require ($vue);
  }


}
?>
<!-- ----- fin ControllerVaccin -->


