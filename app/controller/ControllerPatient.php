
<!-- ----- debut ControllerPatient -->
<?php
require_once '../model/ModelPatient.php';

class ControllerPatient {
  
	// --- Liste des patients
	public static function patientReadAll() {
		$results = ModelPatient::getAll();

		$title = "La liste de l'ensemble des patients";

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/patient/viewAll.php';
		if (DEBUG) echo ("ControllerPatient : patientReadAll : vue = $vue");
		require ($vue);
	}

	// Affiche le formulaire de creation d'un patient
	public static function patientCreate() {
		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/patient/viewInsert.php';
		require ($vue);
	}

	// Affiche un récapitulatif des informations du nouveau patient
	// La clé est gérée par le systeme et pas par l'internaute
	public static function patientCreated() {
		// ajouter une validation des informations du formulaire
		$results = ModelPatient::insert(
		  htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse'])
		);

		//s'il y a eu un problème lors de l'insertion du patient
		if($results == -1){
			$title = "Problème lors de l'insertion du patient";
		}else{
			$title = "Vous venez d'insérer le patient";
		}

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/patient/viewAll.php';
		require ($vue);
	}

}
?>
<!-- ----- fin ControllerPatient -->


