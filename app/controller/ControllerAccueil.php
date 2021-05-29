
<!-- ----- debut ControllerAccueil -->
<?php

class ControllerAccueil {

  // Affichage de la page d'acceuil
  public static function vaccinAccueil() {
    include 'config.php';
    $vue = $root . '/app/view/viewVaccinAccueil.php';
    if (DEBUG) echo ("ControllerAccueil: vaccinAccueil : vue = $vue");
    require ($vue);
  }

}

?>
<!-- ----- fin ControllerAccueil -->


