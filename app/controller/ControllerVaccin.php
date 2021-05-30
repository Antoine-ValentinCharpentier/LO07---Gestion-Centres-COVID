
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

	// Affiche le formulaire de creation d'un vaccin
	public static function vaccinCreate() {
		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/vaccin/viewInsert.php';
		require ($vue);
	}

	// Affiche un récapitulatif des informations du nouveau vaccin
	// La clé est gérée par le systeme et pas par l'internaute
	public static function vaccinCreated() {
		// ajouter une validation des informations du formulaire
		$results = ModelVaccin::insert(
		  htmlspecialchars($_GET['label']), htmlspecialchars($_GET['doses'])
		);
		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/vaccin/viewInserted.php';
		require ($vue);
	}
}
?>
<!-- ----- fin ControllerVaccin -->


