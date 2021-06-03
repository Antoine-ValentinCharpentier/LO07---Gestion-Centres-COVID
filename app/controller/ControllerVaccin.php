
<!-- ----- debut ControllerVaccin -->
<?php
require_once '../model/ModelVaccin.php';

class ControllerVaccin {
  
	// --- Liste des vaccins
	public static function vaccinReadAll() {
		$results = ModelVaccin::getAll();

		$title = "La liste de l'ensemble des vaccins";

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

		//s'il y a eu un problème lors de l'insertion du vaccin
		if($results == -1){
			$title = "Problème lors de l'insertion du vaccin";
			$subtitle = "Assurez-vous que le champ label '" . $_GET['label']."' n'est pas déjà utilisé par un autre vaccin.";
		}else{
			$title = "Vous venez d'insérer le vaccin";
		}

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/vaccin/viewAll.php';
		require ($vue);
	}

	public static function vaccinUpdate() {
		//on récupère l'enssemble des labels qui seront utilisé dans la sélection du nom du vaccin dont ont va changer le nombre de dose

		$results = ModelVaccin::getAllLabel();

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/vaccin/viewUpdate.php';
		require ($vue);
	}

	public static function vaccinUpdated() {
		//on regarde si le nombre de doses est supérieur à 0, il ne peut pas y avoir un nombre de doses inférieur
		if($_GET['doses'] >= 0){
			// On modifie le nombre de doses du vaccin
			$results = ModelVaccin::update(
			  htmlspecialchars($_GET['label']), htmlspecialchars($_GET['doses'])
			);

			$title = "Vous venez de mettre a jour le vaccin :";

		}else{
			//si le nombre de doses n'est pas valide on ne modifie pas la database et on affiche un message d'erreur
			$results = -1;
			$title = "Problème lors de la mise a jour du nombre de doses du vaccin";
			$subtitle = "Assurez-vous que le nombre de doses est supérieur ou égale à 0.";
		}
		
		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/vaccin/viewAll.php';
		require ($vue);
	}

	
}
?>
<!-- ----- fin ControllerVaccin -->


