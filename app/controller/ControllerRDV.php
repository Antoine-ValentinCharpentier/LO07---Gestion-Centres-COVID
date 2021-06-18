
<!-- ----- debut ControllerRDV -->
<?php
require_once '../model/ModelPatient.php';
require_once '../model/ModelRDV.php';
require_once '../model/ModelVaccin.php';
require_once '../model/ModelStock.php';

class ControllerRDV {
  
	// --- Formulaire de sélection d'un patient pour voir son dossier de vaccination
	public static function rdvSelectPatient() {
		$results = ModelPatient::getAll();

		$title = "Veuillez sélectionner le patient dont vous souhaitez accéder à son dossier de vaccination";

		//on définit la cibble du formulaire, on cette vue est utilisé plusieurs fois
		$target = "rdvSelectedPatient";
		//on définit le nom que va prendre le menu de sélection
		$selectName = "idPatient";
		//on initalise la valeur de l'id patient mémoire à -1 (valeur impossible de prendre en temps normal) car on ne l'a pas récupérer mais on va le faire avec ce formulaire
		$idPatient = -1;

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/rdv/viewId.php';

		if (DEBUG) echo ("ControllerRDV : rdvSelectPatient : vue = $vue");
		require ($vue);
	}

	// --- Une fois le patient sélectionné, on regarde ce qu'il faut lui proposer : sélectionner un centre pour recevoir une (nouvellee) dose, ou afficher le bilan de ces vaccins reçu
	public static function rdvSelectedPatient() {

		$idPatient = $_GET["idPatient"];

		//on récupère le patient pour pouvoir afficher son nom et prénom dans les messages
		$patient = ModelPatient::getPatientById($idPatient)[0];

		//On regarde si le patient a déjà reçu une dose, si oui on récupère la dernière
		//ici $listeLast est une liste contenant soit aucun RDV soit le dernier RDV d'injection que le patient a effectué
		$listeLastRDV = ModelRDV::getLastInjection($idPatient);

		//si $listeLastRDV cela signifie que le patient n'a jamais eu d'injection
		if(empty($listeLastRDV)){
			//s'il n'a pas encore reçu d'injection : on définit les textes affichés
			$title = $patient->getPrenom()." ".$patient->getNom()." n'a pas encore reçu d'injection.";
			$subtitle = "Veuillez sélectionner un centre";

			//on récupère l'ensemble des centres ayant au moins une dose, pour que le patient puisse choisir parmis ces centres pour ce faire vacciner
			$results = ModelCentre::getAllWithDoses();
			
			//dans le cadre où aucun centre n'a de doses
			if(empty($results)){
				$results = -1;
				$subtitle = "Vous ne pouvez pas être vacciné pour l'instant. Aucun centre ne dispose de dose";
			}

			//on définit la cible du formulaire 
			$target = "rdvSelectedCentre";
			//on définit le nom que va prendre le menu de sélection
			$selectName = "idCentre";


			// ----- Construction chemin de la vue
			include 'config.php';
			$vue = $root . '/app/view/rdv/viewId.php';
			require ($vue);
		}else {
			//s'il a reçu au moins une dose d'injection du vaccin :

			//on récupère l'objet contenu dans la liste $listeLastRDV qui ne comptient que cette objet
			$lastRDV = $listeLastRDV[0];
			//on récupère le nombre d'injection que la patient a déja eu
			$nbInjection = $lastRDV->getInjection();
			//on récupère le vaccin qu'a eu le patient
			$vaccin = ModelVaccin::getVaccinById($lastRDV->getVaccinId());
			//on récupère le nombre de doses nécessaire au vaccin
			$nbDosesVaccin = $vaccin->getDoses();

			if($nbInjection == $nbDosesVaccin){
				//s'il a reçu toute les injection : on définit les textes affichés
				$title = $patient->getPrenom()." ".$patient->getNom()." a déjà reçu toute les injections nécessaire au vaccin ".$vaccin->getLabel().".";
				$subtitle = "Voici un récapitulatif de ces injections.";

				//on récupère toute les informations sur les injections que le patient a reçu
				$results = ModelRDV::getAllInformationInjection($idPatient);
				// ----- Construction chemin de la vue
				include 'config.php';
				$vue = $root . '/app/view/rdv/viewImmunizationRecord.php';
				require ($vue);
			}else{
				//s'il a reçut qu'une partie des doses : on définit les textes affichés
				$title = $patient->getPrenom()." ".$patient->getNom()." n'a pas encore reçu toute les injections du vaccin ".$vaccin->getLabel()." : (".$nbInjection."/".$nbDosesVaccin." injections)";
				$subtitle = "Veuillez sélectionner un centre pour effectuer l'injection suivante";

				//liste des centres disposant du vaccin qu'a réalisé le patient 
				$results = ModelCentre::getAllWithSpecificVaccin($vaccin->getId());

				//si aucun centre ne peut lui donner une autre injection on lui demande alors d'attendre
				if(empty($results)){
					$results = -1;
					$subtitle = "Vous ne pouvez pas être vacciné pour l'instant. Aucun centre ne dispose de dose pour le vaccin : ".$vaccin->getLabel();
				}

				//on définit la cible du formulaire 
				$target = "rdvSelectedCentre";
				//on définit le nom que va prendre le menu de sélection
				$selectName = "idCentre";

				// ----- Construction chemin de la vue
				include 'config.php';
				$vue = $root . '/app/view/rdv/viewId.php';
				require ($vue);
			}
		}
				
	}

	// --- Injection d'un vaccin a un patient, réduction des stocks du centre, affichage de tout les injections du patient
	public static function rdvSelectedCentre() {
		$idPatient = $_GET['memoireIdPatient'];
		$idCentre = $_GET['idCentre'];
		$injection  = 1;

		//on récupère le patient pour pouvoir afficher son nom et prénom dans les messages
		$patient = ModelPatient::getPatientById($idPatient)[0];

		//on regarde s'il a déjà reçu au moins une dose de vaccin ()
		$listeLastRDV = ModelRDV::getLastInjection($idPatient);

		//on définit le titre de la page
		$title = "L'injection a été réalisée";

		if(empty($listeLastRDV)){
			//dans le cadre d'une première injection
			//on récupère une liste de vaccin proposé par le centre sélectionné où le nombre de doses présentes dans les strock de ce centre est maximal (il peut y en avoir 1 seul ou plusieurs dans les même quantité)
			$listeVaccinPossible = ModelVaccin::getAllVaccinFromCenterLargeAmount($idCentre);
			
			//on en choisit un aléatoirement (si la liste en comporte qu'un seul alors on le choisit systématiquement)
			$vaccinChoisi = $listeVaccinPossible[rand(0,count($listeVaccinPossible)-1)];

			//on définit le sous-titre de la page
			$subtitle = "Le patient ".$patient->getPrenom()." ".$patient->getNom()." vient de recevoir la première dose du vaccin ".$vaccinChoisi->getLabel();

		}else{
			//s'il a déjà reçu une injection,
			//on isole le dernier rdv prit
			$lastRDV = $listeLastRDV[0];

			//on regarde qu'elle vaccin il a déjà reçu
			$vaccinChoisi = ModelVaccin::getVaccinById($lastRDV->getVaccinId());
			print_r($vaccinChoisi);

			//on définit le nouveau nombre d'injection qu'il a reçu
			$injection = 1 + $lastRDV->getInjection();

			//on définit le sous-titre de la page
			$subtitle = "Le patient ".$patient->getPrenom()." ".$patient->getNom()." vient de recevoir la dose ".$injection." du vaccin ".$vaccinChoisi->getLabel();
		}

		//on réduit les stocks du centre d'un vaccin spécifique pour un centre donné
		$nbDosesDansCentre = ModelStock::getQuantiteDoses($idCentre, $vaccinChoisi->getId());
		$results = ModelStock::updateQuantite($idCentre, $vaccinChoisi->getId(), $nbDosesDansCentre-1);

		//on mets maintenant a jour le dossier du patient : on insère ce nouveau rdv dans la base de donnée
		$results = ModelRDV::insertRDV($idCentre,$idPatient,$injection,$vaccinChoisi->getId());

		//on récupère toute les informations sur les injections que le patient a reçu
		$results = ModelRDV::getAllInformationInjection($idPatient);

		// ----- Construction chemin de la vue
		include 'config.php';
		$vue = $root . '/app/view/rdv/viewImmunizationRecord.php';
		require ($vue);
	}

	
}
?>
<!-- ----- fin ControllerRDV -->


