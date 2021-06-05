
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

      //afichage du formulaire pour la saisi d'un centre
      form_begin('form_creation_centre', 'get', 'router.php');
      form_input_hidden('action','centreCreated');
      form_input_text("label :", 'label', 75, 'La Passerelle');
      form_input_text("adresse :", 'adresse', 75, '57 Boulevard de Lamballe, 45400 Fleury-les-Aubrais');
      form_input_submit("Ajouter Centre");
      form_end();

  echo "</div>";

include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewInsert -->



