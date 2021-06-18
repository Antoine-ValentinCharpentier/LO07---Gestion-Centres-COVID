
<!-- ----- debut ControllerInnovation -->
<?php
require_once '../model/ModelInnovation.php';

class ControllerInnovation {
  
	public static function innovationSelectCentre($args) {
		//on regarde vers où on va faire rediriger le formulaire
		$target = $args['target'];

		//on définit les titres de la pages
		$title = "Veuillez choisir un centre";
		$subtitle = "Afin de connaitre son classement par nombre de doses injectées par rapport aux autres centres.";		
		//on récupère l'ensemble des centres
		$results = ModelCentre::getAll();

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/innovation/viewSelectCentre.php';

		require ($vue);
	}

	public static function innovation1Classement() {
		$centre_id = $_GET["idCentre"];
		//on définit les titres de la pages
		$title = "Informations sur le nombre d'injections des vaccins aux patients";
		$subtitle = "Le classement du nombre total d'injections par type de vaccin aux patients par rapport aux autres centres est présenté dans ce tableau.";

		//on calcule la somme de chaque injections pour chaque vaccin pour chaque centre différent
		$tableauSommeInjection = ModelInnovation::innovation1NbInjection();

		//on calcule le classement parmit l'ensemble des centres pour chaque vaccin
		//et on ne garde dans $results que les informations pour le centre souhaité
		$numLigne = 1;
		$precedentVaccinLabel = "";
		$indexResults = 0;
		$results = [];
		foreach ($tableauSommeInjection as $tuple) {
			if($precedentVaccinLabel != $tuple["vaccinLabel"]){
				$numLigne = 1;
				$precedentVaccinLabel = $tuple["vaccinLabel"];
			}
			if($tuple["centreId"] == $centre_id){
				$results[$indexResults] = $tuple; 
				$results[$indexResults]["classement"] = $numLigne;
				$indexResults++;
			}
			$numLigne++;
		}

		if(empty($results)){
			$subtitle = "Ce centre n'a pas encore réalisé d'injection auprès de patient.";
		}

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/innovation/viewInnovation1.php';
		require ($vue);
	}

	public static function innovation2Localisation() {
		$results = ModelCentre::getAll();

		$title = "Accéder à la localisation d'un centre de vaccination via Google Map";
		$subtitle = "Cliquez sur un lien pour ouvrir la carte avec le centre";

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/innovation/viewInnovation2.php';
		require ($vue);
	}

	public static function innovation3Bilan() {
		$nbPersonneNoneVaccine = ModelInnovation::nombrePersonneNonVaccine();
		$results = ModelInnovation::combienDosesVaccinUtiliseParTypeVaccin();

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/innovation/viewInnovation3.php';
		require ($vue);
	}


}
?>
<!-- ----- fin ControllerInnovation -->


