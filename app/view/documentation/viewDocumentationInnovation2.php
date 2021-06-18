
<!-- ----- début viewDocumentationInnovation2 -->
<?php

require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
?>

<body>
  <div class="container">
    <?php
    //on affiche l'entête de la page : Menu + Jumbotron
    include $root . '/app/view/fragment/fragmentVaccinMenu.html';
    include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';

    ?>

    <h1>Documentation innovation 2</h1>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">En quoi consiste cette innovation ? En quoi est-elle originale ?</div>
      <div class="panel-body">
      Cette deuxième innovation permet de proposer à l'utilisateur d'accéder à la localisation d'un centre choisi sur google map après avoir cliqué sur le lien associé à ce centre dans un tableau. La liste des centres est affiché avec leur adresse ainsi qu'un lien vers une page de google map qui indique la position du centre sur une carte. Cette amélioration peut permettre à l'utilisateur de se rendre plus rapidement et plus facilement à un centre donné. Il n'a pas besoin de saisir et de recopier l'adresse du lieu où il va se faire vacciner. 
      </div>
    </div>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">Comment fonctionne-t-elle ?</div>
      <div class="panel-body">
      L'utilisateur clique sur l'onglet Documentation>Innovation 2, puis la donné action = "innovation2Localisation" permet de se rediriger vers le ControllerInnovation et qui appelle la méthode innovation2Localisation. Cette méthode récupère l'ensemble des centres par l'intermédiaire du modeleCentre avec la méthode getAll(). Ensuite le controller appelle la vue viewInnovation2.php. Dans cette vue on génère un tableau avec trois colonnes : le nom du centre, l'adresse, et le lien google map. Les deux première colonnes de ce tableu sont directement remplit avec les valeurs récupérer par le controler, tandis que que la dernière colonne consacré au lien vers google map est remplit sous la forme "https://www.google.fr/maps/dir/".adresse_du_centre avec des hyperliens.
      </div>
    </div>
    <br>




  <?php
  ///on affiche le bas de page
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; 
  ?>

  <!-- ----- fin viewDocumentationInnovation2 -->
  
  
  