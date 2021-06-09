
<!-- ----- debut ModelStock -->

<?php
require_once 'Model.php';

class ModelStock {
    private $centre_id, $vaccin_id, $quantite;

    // pas possible d'avoir 2 constructeurs
    public function __construct($centre_id = NULL, $vaccin_id = NULL, $quantite = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($centre_id)) {
            $this->setCentreId($centre_id);
            $this->setVaccinId($vaccin_id);
            $this->setQuantite($quantite);
        }
    }

    //setter
    function setCentreId($centre_id) {
        $this->centre_id = $centre_id;
    }

    function setVaccinId($vaccin_id) {
        $this->vaccin_id = $vaccin_id;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    //getter
    function getCentreId() {
        return $this->centre_id;
    }

    function getVaccinId() {
        return $this->vaccin_id;
    }

    function getQuantite() {
        return $this->quantite;
    }


    // retourne une liste avec tout les stock
    public static function getStockUnitaireCentre() {
        try {
            $database = Model::getInstance();
            $query = "SELECT C.label AS labelCentre, V.label AS labelVaccin, S.quantite FROM stock S, centre C, vaccin V where S.centre_id = C.id AND V.id = S.vaccin_id ORDER BY C.label";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function getStockGlobalCentre() {
        try {
            $database = Model::getInstance();
            $query = "SELECT C.label AS labelCentre, SUM(S.quantite) as sommeDoses FROM stock S, centre C where S.centre_id = C.id GROUP BY centre_id ORDER BY SUM(S.quantite) DESC";
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
<!-- ----- fin ModelVaccin -->


