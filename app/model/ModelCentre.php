<!-- ----- debut ModelCentre -->

<?php
require_once 'Model.php';

class ModelCentre {
  private $id, $label, $adresse;

  // pas possible d'avoir 2 constructeurs
  public function __construct($id = NULL, $label = NULL, $adresse = NULL) {
    // valeurs nulles si pas de passage de parametres
    if (!is_null($id)) {
     $this->setId($id);
     $this->setLabel($label);
     $this->setAdresse($adresse);
    }
  }

  //setter
  function setId($id) {
    $this->id = $id;
  }

  function setLabel($label) {
    $this->label = $label;
  }

  function setAdresse($adresse) {
    $this->adresse = $adresse;
  }

  //getter
  function getId() {
    return $this->id;
  }

  function getLabel() {
    return $this->label;
  }

  function getAdresse() {
    return $this->adresse;
  }


  // retourne une liste avec tout les centres
  public static function getAll() {
    try {
      $database = Model::getInstance();
      $query = "select * from centre";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //permet d'insérer un nouveau tuple centre dans la table centre
  public static function insert($label, $adresse) {
    try {
      $database = Model::getInstance();

      // recherche de la valeur de la clé primaire id = max(id) + 1
      $query = "select max(id) from centre";
      $statement = $database->query($query);
      $tuple = $statement->fetch();
      $id = $tuple['0'];
      $id++;

      // ajout d'un nouveau tuple centre
      $query = "insert into centre value (:id, :label, :adresse)";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id,
        'label' => $label,
        'adresse' => $adresse
      ]);

      //on récupère le centre qui vient d'être crée pour pouvoir l'afficher
      $results = ModelCentre::getCentreById($id);

      return $results;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

  //fonction qui retourne le centre avec un id précis
  public static function getCentreById($id) {
    try {
      $database = Model::getInstance();
      $query = "select * from centre where id = :id";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");

      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }
}
?>
<!-- ----- fin ModelCentre -->


