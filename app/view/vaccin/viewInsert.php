
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

      //afichage du formulaire
      form_begin('form_creation_vaccin', 'get', 'router.php');
      form_input_hidden('action','vaccinCreated');
      form_input_text("label :", 'label', 75, 'AstraZeneca');
      form_input_number("doses :", "doses", 2);
      form_input_submit("Ajouter Vaccin");
      form_end();

  echo "</div>";

include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewInsert -->



