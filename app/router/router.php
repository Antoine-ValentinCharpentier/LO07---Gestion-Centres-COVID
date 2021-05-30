
<!-- ----- debut Router -->
<?php
require ('../controller/ControllerAccueil.php');
require ('../controller/ControllerVaccin.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

//Modification du routeur pour prendre en compte l'ensemble des paramètres
$action = $param['action'];

//On supprime l'élément action de la structure
unset($param['action']);

//Tout ce qui reste sont des arguments
$args = $param;

// --- Liste des méthodes autorisées
switch ($action) {
	//les vaccins
	case 'vaccinReadAll':
		ControllerVaccin::$action($args);
  		break;

	// Tache par défaut
	default:
		$action = "vaccinAccueil";
		ControllerAccueil::$action();
}
?>
<!-- ----- Fin Router -->