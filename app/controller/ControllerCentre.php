
<!-- ----- debut ControllerCentre -->
<?php
require_once '../model/ModelCentre.php';

class ControllerCentre {
  
	// --- Liste des centres
	public static function centreReadAll() {
		$results = ModelCentre::getAll();

		$title = "La liste de l'ensemble des centres";

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/centre/viewAll.php';
		if (DEBUG) echo ("ControllerCentre : centreReadAll : vue = $vue");
		require ($vue);
	}

	// Affiche le formulaire de creation d'un centre
	public static function centreCreate() {
		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/centre/viewInsert.php';
		require ($vue);
	}

	// Affiche un récapitulatif des informations du nouveau centre
	// La clé est gérée par le systeme et pas par l'internaute
	public static function centreCreated() {
		// ajouter une validation des informations du formulaire
		$results = ModelCentre::insert(
		  htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse'])
		);

		//s'il y a eu un problème lors de l'insertion du centre
		if($results == -1){
			$title = "Problème lors de l'insertion du centre";
		}else{
			$title = "Vous venez d'insérer le centre";
		}

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/centre/viewAll.php';
		require ($vue);
	}

}
?>
<!-- ----- fin ControllerCentre -->


