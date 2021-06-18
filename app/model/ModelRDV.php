<!-- ----- debut ModelRDV -->

<?php
require_once 'Model.php';

class ModelRDV {
  private $centre_id, $patient_id, $injection, $vaccin_id;

  // pas possible d'avoir 2 constructeurs
  public function __construct($centre_id = NULL, $patient_id = NULL, $injection = NULL, $vaccin_id = NULL) {
    // valeurs nulles si pas de passage de parametres
    if (!is_null($centre_id)) {
     $this->setCentreId($centre_id);
     $this->setPatientID($patient_id);
     $this->setInjection($injection);
     $this->setVaccinId($vaccin_id);
    }
  }

  //setter
  function setCentreId($centre_id) {
    $this->centre_id = $centre_id;
  }

  function setPatientID($patient_id) {
    $this->patient_id = $patient_id;
  }

  function setInjection($injection) {
    $this->injection = $injection;
  }

  function setVaccinId($vaccin_id) {
    $this->vaccin_id = $vaccin_id;
  }

  //getter
  function getCentreId() {
    return $this->centre_id;
  }

  function getPatientID() {
    return $this->patient_id;
  }
  function getInjection() {
    return $this->injection;
  }

  function getVaccinId() {
    return $this->vaccin_id;
  }


  // retourne la dernière injection d'un patient
  public static function getLastInjection($patientId) {
    try {
      $database = Model::getInstance();
      $query = "SELECT * FROM rendezvous WHERE patient_id = :patient_id AND injection = (SELECT MAX(injection) FROM rendezvous WHERE patient_id = :patient_id)";
      $statement = $database->prepare($query);
      $statement->execute([
          'patient_id' => $patientId
      ]);
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRDV");
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  // retourne la dernière injection d'un patient
  public static function getAllInformationInjection($patientId) {
    try {
      $database = Model::getInstance();
      $query = "SELECT C.label AS centreLabel, C.adresse AS centreAdresse, V.label AS vaccinLabel, RDV.injection AS injection FROM rendezvous RDV, centre C, vaccin V WHERE RDV.patient_id = :patient_id AND C.id = RDV.centre_id AND V.id = RDV.vaccin_id";
      $statement = $database->prepare($query);
      $statement->execute([
          'patient_id' => $patientId
      ]);
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }

  //permet d'insérer un nouveau tuple patient dans la table patient
  public static function insertRDV($centre_id,$patient_id,$injection,$vaccin_id) {
    try {
      $database = Model::getInstance();

      // ajout d'un nouveau tuple RDV
      $query = "insert into rendezvous value (:centre_id, :patient_id, :injection, :vaccin_id)";
      $statement = $database->prepare($query);
      $statement->execute([
        'centre_id' => $centre_id,
        'patient_id' => $patient_id,
        'injection' => $injection,
        'vaccin_id' => $vaccin_id
      ]);

      return 0;
    }catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
  }
}
?>
<!-- ----- fin ModelRDV -->


