
<!-- ----- début viewInsertDose-->
 
<?php 
require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
require ($root . '/outil/lo07_biblio_formulaire_bt.php');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentVaccinMenu.html';
      include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';
      
      //on affiche le titre de la page
      if(isset($title)){
        echo "<h3>$title</h3>";
      }

      //afichage du formulaire
      form_begin('form_ajouter_doses_centre', 'get', 'router.php');
      form_input_hidden('action','stockInsertedDose');
      
      //champ de sélection parmit les différents centres
      form_select_table('Nom du centre', 'idCentre', '', 4, $listeCentre);

      //champ de saisit pour chaque autre vaccin
      foreach ($listeVaccin as $vaccin) {
        form_input_number($vaccin->getLabel()." (id: ".$vaccin->getId().")", $vaccin->getId(), 0);
      }

      form_input_submit("Ajouter doses");
      
      form_end();

  echo "</div>";

include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewInsertDose -->



