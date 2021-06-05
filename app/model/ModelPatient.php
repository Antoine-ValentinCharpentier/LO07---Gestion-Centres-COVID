<!-- ----- debut ModelPatient -->

<?php
require_once 'Model.php';

class ModelPatient {
  private $id, $nom, $prenom, $adresse;

  // pas possible d'avoir 2 constructeurs
  public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL) {
    // valeurs nulles si pas de passage de parametres
    if (!is_null($id)) {
     $this->setId($id);
     $this->setNom($nom);
     $this->setPrenom($nom);
     $this->setAdresse($adresse);
    }
  }

  //setter
  function setId($id) {
    $this->id = $id;
  }

  function setNom($nom) {
    $this->nom = $nom;
  }

  function setPrenom($prenom) {
    $this->prenom = $prenom;
  }

  function setAdresse($adresse) {
    $this->adresse = $adresse;
  }

  //getter
  function getId() {
    return $this->id;
  }

  function getNom() {
    return $this->nom;
  }
  function getPrenom() {
    return $this->prenom;
  }

  function getAdresse() {
    return $this->adresse;
  }


  // retourne une liste avec tout les patients
  public static function getAll() {
    try {
      $database = Model::getInstance();
      $query = "select * from patient";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //permet d'insérer un nouveau tuple patient dans la table patient
  public static function insert($nom, $prenom, $adresse) {
    try {
      $database = Model::getInstance();

      // recherche de la valeur de la clé primaire id = max(id) + 1
      $query = "select max(id) from patient";
      $statement = $database->query($query);
      $tuple = $statement->fetch();
      $id = $tuple['0'];
      $id++;

      // ajout d'un nouveau tuple patient
      $query = "insert into patient value (:id, :nom, :prenom, :adresse)";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse
      ]);

      //on récupère le patient qui vient d'être crée pour pouvoir l'afficher
      $results = ModelPatient::getPatientById($id);

      return $results;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

  //fonction qui retourne le patient avec un id précis
  public static function getPatientById($id) {
    try {
      $database = Model::getInstance();
      $query = "select * from patient where id = :id";
      $statement = $database->prepare($query);
      $statement->execute([
        'id' => $id
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");

      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }
}
?>
<!-- ----- fin ModelPatient -->


