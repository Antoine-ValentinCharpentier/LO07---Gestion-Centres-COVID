<!-- ----- debut ModelInnovation -->

<?php
require_once 'Model.php';

class ModelInnovation {


  public static function innovation1NbInjection() {
    try {
      $database = Model::getInstance();
      $query = "SELECT C.id AS centreId, C.label AS centreLabel, V.label AS vaccinLabel, COUNT(*) AS nbInjection FROM rendezvous RDV, vaccin V, centre C, patient P WHERE RDV.centre_id = C.id AND V.id = RDV.vaccin_id AND P.id = RDV.patient_id GROUP BY RDV.centre_id, RDV.vaccin_id ORDER BY V.label, nbInjection DESC";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  
  //Permet d'obtenir le nombre de personne pas vacciné
  public static function nombrePersonneNonVaccine() {
    try {
      $database = Model::getInstance();

      //on récupère dans un premier temps le nombre de personne vaccine
      $query = "SELECT count(DISTINCT patient_id) AS nbPatientVaccine FROM rendezvous";
      $statement = $database->prepare($query);
      $statement->execute();
      $nbPersonneVaccine = $statement->fetchAll(PDO::FETCH_ASSOC);

      //on récupère maintenant le nombre de patient total 
      $query = "SELECT count(DISTINCT id) AS nbPatient FROM patient";
      $statement = $database->prepare($query);
      $statement->execute();
      $nbPatient = $statement->fetchAll(PDO::FETCH_ASSOC);

      return $nbPatient[0]["nbPatient"]-$nbPersonneVaccine[0]["nbPatientVaccine"];
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }

  //permet de connaitre combien d'injection de chaque vaccin ont était distribué
  public static function combienDosesVaccinUtiliseParTypeVaccin() {
    try {
      $database = Model::getInstance();

      $query = "SELECT V.label AS vaccinLabel, COUNT(*) AS nombre FROM rendezvous RDV, vaccin V WHERE RDV.vaccin_id = V.id GROUP BY RDV.vaccin_id";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
    }
  }
}
?>
<!-- ----- fin ModelInnovation -->


