
<!-- ----- début viewInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
require ($root . '/outil/lo07_biblio_formulaire_bt.php');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentVaccinMenu.html';
      include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';

      //afichage du formulaire pour la saisi d'un patient
      form_begin('form_creation_patient', 'get', 'router.php');
      form_input_hidden('action','patientCreated');
      form_input_text("nom :", 'nom', 40, 'Charpentier');
      form_input_text("prenom :", 'prenom', 40, 'Antoine-Valentin');
      form_input_text("adresse :", 'adresse', 80, 'Orléans');
      form_input_submit("Ajouter Patient");
      form_end();

  echo "</div>";

include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewInsert -->



