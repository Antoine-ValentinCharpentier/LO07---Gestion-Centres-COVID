
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
    

    echo"<h3>Nombre de personnes non vaccinées</h3>";
    echo $nbPersonneNoneVaccine;


    echo "<h3>Nombre de doses utilisées pour chaque type de vaccin</h3>";
    ?>
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">Nom du vaccin</th>
          <th scope = "col">Nombre d'injection réalisée</th>
        </tr>
      </thead>
      <tbody>
          <?php
     
          foreach ($results as $tuple) {
           printf("<tr><td>%s</td><td>%d</td></tr>", $tuple["vaccinLabel"],$tuple["nombre"]);
          }
          ?>
      </tbody>
    </table>
  
  </div>


  <?php
  ///on affiche le bas de page
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; 
  ?>

  <!-- ----- fin viewAll -->
  
  
  