
<!-- ----- début viewDocumentationInnovation3 -->
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

    <h1>Documentation innovation 3</h1>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">En quoi consiste cette innovation ? En quoi est-elle originale ?</div>
      <div class="panel-body">
      Cette troisième innovation permet de connaître le nombre de personnes restantes n'ayant pas encore reçu au moins une dose d'un vaccin contre la covid. Puis dans un second temps, elle permet d'afficher des statistiques dans lesquels nous pouvons apercevoir la somme totale des doses injectées tout centre confondu par type de vaccin.
      </div>
    </div>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">Comment fonctionne-t-elle ?</div>
      <div class="panel-body">
      L'utilisateur clique sur l'onglet Documentation>Innovation 3, puis la donnée action = "innovation3Bilan" permet de se rediriger vers le ControllerInnovation et qui appelle la méthode innovation3Bilan. Cette méthode appelle la méthode nombrePersonneNonVaccine() du ModelInnovation qui récupère le nombre total de patient présent dans la table patient, puis récupère le nombre total de patient ayant reçu au minimum une dose, puis réalise la soustraction entre ces deux valeurs dont le résultat sera stocké dans la variable $nbPersonneNoneVaccine. Une fois cette première étape de réalisé, le ControllerInnovation demande au ModelInnovation d'établi une liste contenant l'association d'un nom de vaccin avec le nombre total d'injections réalisé avec ce vaccin, ce tableau est alors stocké dans la variable $results qui sera affiché dans viewInnovation3.php sous les traits d'un tableau à deux dimensions.
      </div>
    </div>
    <br>




  <?php
  ///on affiche le bas de page
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; 
  ?>

  <!-- ----- fin viewDocumentationInnovation3 -->
  
  
  