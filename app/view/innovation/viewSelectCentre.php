
<!-- ----- début viewAllCentre -->
 
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

      if(isset($subtitle)){
        echo "<p>$subtitle</p>";
      }

      //afichage du formulaire
      form_begin('form_rdv_select_centre', 'get', 'router.php');
      //bouton invisible permettant de définir vers où le formulaire doit repartir
      form_input_hidden('action',$target);
      
      //champ de sélection parmit les différents centres
      form_select_table('', "idCentre", '', 4, $results);

      //bouton submit du formulaire
      form_input_submit("Accéder");
      form_end();  

  echo "</div>";
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; ?>

<!-- ----- fin viewAllCentre -->



