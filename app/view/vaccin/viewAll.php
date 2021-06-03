
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

    //si la variable $results n'est pas vide, alors on affiche l'ensemble des vaccins présent dans cette variable
    if($results != -1){

    ?>

      <table class = "table table-striped table-bordered">
        <thead>
          <tr>
            <th scope = "col">id</th>
            <th scope = "col">label</th>
            <th scope = "col">doses</th>
          </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vaccins est dans une variable $results             
            foreach ($results as $vaccin) {
             printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>", $vaccin->getId(), $vaccin->getLabel(), $vaccin->getDoses());
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
  
  
  