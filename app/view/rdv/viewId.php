
<!-- ----- début viewId -->
 
<?php 
require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
require ($root . '/outil/lo07_biblio_formulaire_bt.php');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentVaccinMenu.html';
      include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';

      //on affiche le titre de la page, si il est définit
      if(isset($title)){
        echo "<h3>$title</h3>";
      }

      //afichage du formulaire
      form_begin('form_rdv_select_patient', 'get', 'router.php');
      form_input_hidden('action','rdvSelectedPatient');
      
      //champ de sélection parmit les différents centres
      form_select_table('Liste des patients', 'idPatient', '', 4, $results);

      //bouton submit du formulaire
      form_input_submit("Accéder");
      form_end();  

  echo "</div>";
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewId -->



