<?php 
  //Affichage de la page d'accueil
  include 'fragment/fragmentVaccinHeader.html'; 
?>
<body>
  <div class="container">
    <?php
    include 'fragment/fragmentVaccinMenu.html';
    include 'fragment/fragmentVaccinJumbotron.html';
    ?>
    <h1>Bienvenue sur le site de gestion des centres de vaccination contre la COVID</h2>
  </div>   

  <?php
  include 'fragment/fragmentVaccinFooter.html';
  ?>

</body>
</html>