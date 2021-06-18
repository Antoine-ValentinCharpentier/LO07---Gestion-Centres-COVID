
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
?>

<body>
  <div class="container">
    <?php
    //on affiche l'entête de la page : Menu + Jumbotron
    include $root . '/app/view/fragment/fragmentVaccinMenu.html';
    include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';

    //on affiche le titre de la page
    if(isset($title)){
      echo "<h3>$title</h3>";
    }
    //on affiche le sous titre de la page
    if (isset($subtitle)) {
      echo $subtitle;
    }

    //si la variable $results n'est pas vide, alors on affiche l'ensemble des centres présent dans cette variable
    if(!empty($results)){
    ?>

      <table class = "table table-striped table-bordered">
        <thead>
          <tr>
            <th scope = "col">Nom du centre</th>
            <th scope = "col">Nom du vaccin</th>
            <th scope = "col">Somme doses injecté</th>
            <th scope = "col">Classement par rapport aux autres centres</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            // La liste des patients est dans la variable $results             
            foreach ($results as $tuple) {
             printf("<tr><td>%s</td><td>%s</td><td>%d</td><td>%d</td></tr>", $tuple["centreLabel"], $tuple["vaccinLabel"], $tuple["nbInjection"], $tuple["classement"]);
             $i++;
            }
            ?>
        </tbody>
      </table>
    <?php
    }
    ?>
  </div>


  <?php
  ///on affiche le bas de page
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; 
  ?>

  <!-- ----- fin viewAll -->
  
  
  