
<!-- ----- debut ModelVaccin -->

<?php
require_once 'Model.php';

class ModelVaccin {
  private $id, $label, $doses;

  // pas possible d'avoir 2 constructeurs
  public function __construct($id = NULL, $label = NULL, $doses = NULL) {
    // valeurs nulles si pas de passage de parametres
    if (!is_null($id)) {
     $this->setId($id);
     $this->setLabel($label);
     $this->setDoses($doses);
    }
  }

  //setter
  function setId($id) {
    $this->id = $id;
  }

  function setLabel($label) {
    $this->label = $label;
  }

  function setDoses($doses) {
    $this->doses = $doses;
  }

  //getter
  function getId() {
    return $this->id;
  }

  function getLabel() {
    return $this->label;
  }

  function getDoses() {
    return $this->doses;
  }


  // retourne une liste avec tout les vaccins
  public static function getAll() {
    try {
      $database = Model::getInstance();
      $query = "select * from vaccin";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //fonction qui retourne le vaccin avec un label précis
  public static function getVaccinByLabel($label) {
    try {
      $database = Model::getInstance();
      $query = "select * from vaccin where label = :label";
      $statement = $database->prepare($query);
      $statement->execute([
        'label' => $label
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");

      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //fonction qui retourne le vaccin avec un label précis
  public static function getVaccinById($id) {
    try {
      $database = Model::getInstance();
      $query = "select * from vaccin where id = :id";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");

      return $results[0];
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //fonction qui permet de récupérer l'enssemble des vaccins présent dans les plus grande quantité d'un centre donné
  public static function getAllVaccinFromCenterLargeAmount($idCentre) {
    try {
      $database = Model::getInstance();
      $query = "SELECT V.* FROM stock S, centre C, vaccin V where V.id = S.vaccin_id AND C.id = S.centre_id AND S.centre_id = :id_centre AND S.quantite != 0 AND S.quantite = (SELECT MAX(quantite) FROM stock WHERE centre_id = :id_centre)";
      $statement = $database->prepare($query);
      $statement->execute([
        'id_centre' => $idCentre
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");

      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //permet d'insérer un nouveau tuple vaccin dans la table vaccin
  public static function insert($label, $doses) {
    try {
      $database = Model::getInstance();

      //on regarde d'abord s'il n'y a pas déjà ce label pour un vaccin existant
      $query = "select * from vaccin where label= '$label'";
      $statement = $database->query($query);
      $nb_tuple = $statement->rowCount();
      if($nb_tuple != 0){
        return -1;
      }

      // recherche de la valeur de la clé = max(id) + 1
      $query = "select max(id) from vaccin";
      $statement = $database->query($query);
      $tuple = $statement->fetch();
      $id = $tuple['0'];
      $id++;

      // ajout d'un nouveau tuple;
      $query = "insert into vaccin value (:id, :label, :doses)";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id,
        'label' => $label,
        'doses' => $doses
      ]);

      //on le récupère pour pouvoir l'afficher
      $results = ModelVaccin::getVaccinByLabel($label);

      return $results;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

  //fonction qui retourne l'ensemble des labels
  public static function getAllLabel() {
    try {
      $database = Model::getInstance();
      $query = "select label from vaccin";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
      return $results;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //fonction qui permet de mettre a jour le nombre de doses d'un vaccin
  public static function update($label,$doses) {
    try {
      //on mets a jour le nombre de dose d'un vaccin
      $database = Model::getInstance();

      $query = "update vaccin set doses = :doses where label = :label";
      $statement = $database->prepare($query);
      $statement->execute([
        'doses' => $doses,
        'label' => $label
      ]);

      //on le récupère pour pouvoir l'afficher
      $results = ModelVaccin::getVaccinByLabel($label);

      //on return le vaccin modifié
      return $results;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }
  
}
?>
<!-- ----- fin ModelVaccin -->


