
<!-- ----- début viewAvis -->
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

    <h1>Notre avis global sur ce projet</h1>
    <br>

    <div class="panel panel-success">
      <div class="panel-heading">Points fort du projet</div>
      <div class="panel-body">
        - Le sujet du projet porte sur une thématique actuelle<br>
        - Possibilité de travailler en groupe ou tout seul selon nos choix<br>
        - Cela nous a permis de découvrir le logiciel de versionning GIT au travers l'utilisation de GitHub que l'on va réutiliser dans notre future carrière et dans nos futurs projets.<br>
        - Cela nous a permis de comprendre plus en profondeur le modèle MVC.<br>
        - Nous avons beaucoup apprécié être moins guider que les différents travaux pratiques, ce qui nous donne une forme de liberté<br>
        - De plus, le sujet est bien expliqué, sans superflu (contrairement aux tp (selon nous))<br>
      </div>
    </div>
    <br>

    <div class="panel panel-danger">
      <div class="panel-heading">Points faible du projet</div>
      <div class="panel-body">
        - Etre obligé de se restreindre à utiliser bootstrap, au lieu de créer la propre apparence de son site avec les différentes règles CSS.<br>
        - C'est un peut dommage de ne pas avoir réfléchi sur comment organiser les données dans les bases de données, car elles ont été donné avant de commencer le projet. <br>
      </div>
    </div>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">Suggestions d'amélioration du projet</div>
      <div class="panel-body">
        - Système de planification de rendez-vous sur des plages horaires, avec la mise en place d'un calendrier de vaccination<br>
        - Il faudrait instaurer une limite minimum d'age pour prétendre a un vaccin (exemple AstraZeneca), mettre des priorité pour les patients en fonction de leur age, leurs conditions de santé, ...<br>
        - Système de connexion pour les clients, création d'un espace client. Distinguer l'affichage dédié aux centre de celui des clients.<br>
        - Ajouter la possibilité de modifier son profil, ajouter d'avantage d'informations sur celui-ci (numéro de sécurité social, numéro de téléphone pour pouvoir les contacter, ...)<br>
        - Ajouter un système qui averti les personnes qui veulent se faire vacciner une fois qu'une dose est disponible dans un centre donné<br>
        - ...
      </div>
    </div>


  <?php
  ///on affiche le bas de page
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; 
  ?>

  <!-- ----- fin viewAvis -->
  
  
  