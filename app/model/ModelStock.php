
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

    //Retourne le nombre total de doses par centre présent dans les stocks
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

    //permet de récupérer l'ensemble des vaccins présent dans les stocks d'un centre donné
    public static function getStockUnitaireCentreAvecIdParticulier($centre_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT C.label AS labelCentre, V.label AS labelVaccin, S.quantite FROM stock S, centre C, vaccin V where S.centre_id = C.id AND V.id = S.vaccin_id AND S.centre_id=:centre_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'centre_id' => $centre_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    //met a jour la quantité d'un certain vaccin pour un centre donné
    public static function updateQuantite($centre_id, $vaccin_id, $quantite) {
        try {
            $database = Model::getInstance();
            $query = "update stock set quantite=:quantite where centre_id=:centre_id AND vaccin_id = :vaccin_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'quantite' => $quantite,
                'centre_id' => $centre_id,
                'vaccin_id' => $vaccin_id
            ]);

            return 0;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    //permet de récupérer un nombrbe de doses présent dans le stock d'un centre pour un vaccin donné
    public static function getQuantiteDoses($centre_id, $vaccin_id) {
        try {
            $database = Model::getInstance();
            $query = "select quantite from stock where centre_id=:centre_id AND vaccin_id = :vaccin_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'centre_id' => $centre_id,
                'vaccin_id' => $vaccin_id,
            ]);
            $tuple = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            $results = $tuple[0];

            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    //permet d'insérer un nouveau tuple dans la table stock
    public static function insert($centre_id, $vaccin_id, $quantite) {
        try {
            $database = Model::getInstance();
            $query = "insert into stock value (:centre_id, :vaccin_id, :quantite)";
            $statement = $database->prepare($query);
            $statement->execute([
                'centre_id' => $centre_id,
                'vaccin_id' => $vaccin_id,
                'quantite' => $quantite
            ]);

            return 0;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    //permet d'insérer ou de mettre a jour un nouveau tuple stock dans la table stock
    public static function ajoutNouvelleDoses($centre_id, $vaccin_id, $quantite) {
        try {
            $database = Model::getInstance();

            //on regarde d'abord s'il y a déjà un tuple associé à la clé primaire (centre_id, vaccin_id)
            $query = "select * from stock where centre_id= '$centre_id' and vaccin_id= '$vaccin_id'";
            $statement = $database->query($query);
            $nb_tuple = $statement->rowCount();

            if($nb_tuple != 0){
                //s'il existe déjà un tuple, alors il faut lui augmenter le nombre de doses

                //on récupère dans un premier temps le nombre de doses qu'il avait déjà
                $ancienNombreDeDoses = ModelStock::getQuantiteDoses($centre_id, $vaccin_id);
                if($ancienNombreDeDoses == -1){
                    return -1;
                }

                //on ajoute le nombre de doses initiale au nombre de doses que l'on rajoute
                $quantite+=$ancienNombreDeDoses;

                //on mets a jour la quantite de doses pour le tuple ayant la clé primaire (centre_id, vaccin_id)
                $results = ModelStock::updateQuantite($centre_id, $vaccin_id, $quantite);
                if($results == -1){
                    return -1;
                }
            }else{
                //s'il n'y a pas déjà de tuple, il faut alors le créer

                // ajout d'un nouveau tuple;
                $results = ModelStock::insert($centre_id, $vaccin_id, $quantite);
                if($results == -1){
                    return -1;
                }
            }
            
            return 0;
        }catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
?>
<!-- ----- fin ModelVaccin -->


