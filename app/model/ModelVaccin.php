
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

  //permet d'insérer un nouveau tuple vaccin dans la table vaccin
  public static function insert($label, $doses) {
    try {
      $database = Model::getInstance();

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
      return $id;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

}
?>
<!-- ----- fin ModelVaccin -->


