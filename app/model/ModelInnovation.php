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
}
?>
<!-- ----- fin ModelInnovation -->


