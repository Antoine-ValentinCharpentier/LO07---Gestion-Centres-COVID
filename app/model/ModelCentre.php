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

  // retourne une liste avec tout les centres ayant au minimum 1 doses de vaccin
  public static function getAllWithDoses() {
    try {
      $database = Model::getInstance();
      $query = "SELECT C.* FROM stock S, centre C where S.centre_id = C.id AND S.quantite != 0 GROUP BY centre_id ORDER BY SUM(S.quantite) DESC";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  // retourne une liste avec tout les centres ayant au minimum 1 doses d'un vaccin particulier
  public static function getAllWithSpecificVaccin($id) {
    try {
      $database = Model::getInstance();
      $query = "SELECT C.* FROM stock S, centre C where S.centre_id = C.id AND S.vaccin_id = :vaccin_id AND S.quantite != 0 GROUP BY centre_id ORDER BY SUM(S.quantite) DESC";
      $statement = $database->prepare($query);
      $statement->execute([
        'vaccin_id' => $id
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //permet d'ins??rer un nouveau tuple centre dans la table centre
  public static function insert($label, $adresse) {
    try {
      $database = Model::getInstance();

      // recherche de la valeur de la cl?? primaire id = max(id) + 1
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

      //on r??cup??re le centre qui vient d'??tre cr??e pour pouvoir l'afficher
      $results = ModelCentre::getCentreById($id);

      return $results;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

  //fonction qui retourne le centre avec un id pr??cis
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


