
<!-- ----- debut ControllerRDV -->
<?php
require_once '../model/ModelPatient.php';
require_once '../model/ModelVaccin.php';

class ControllerRDV {
  
	// --- Formulaire de sélection d'un patient pour voir son dossier de vaccination
	public static function rdvSelectPatient() {
		$results = ModelPatient::getAll();

		$title = "Veuillez sélectionner le patient dont vous souhaitez accéder à son dossier de vaccination";

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/rdv/viewId.php';

		if (DEBUG) echo ("ControllerRDV : rdvSelectPatient : vue = $vue");
		require ($vue);
	}

}
?>
<!-- ----- fin ControllerRDV -->


