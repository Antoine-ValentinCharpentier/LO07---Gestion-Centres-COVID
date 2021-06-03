
<!-- ----- début viewUpdate -->
 
<?php 
require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
require ($root . '/outil/lo07_biblio_formulaire_bt.php');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentVaccinMenu.html';
      include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';

      //afichage du formulaire pour la modification du nombre de dose d'un vaccin
      form_begin('form_mise_a_jour_vaccin', 'get', 'router.php');
      form_input_hidden('action','vaccinUpdated');
      form_select('label :', 'label', "", 4, $results);
      form_input_number("doses :", "doses", 0);
      form_input_submit("Mise a jour du vaccin");
      form_end();

  echo "</div>";

include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewUpdate -->



