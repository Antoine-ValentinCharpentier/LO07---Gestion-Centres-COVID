
<!-- ----- début viewDocumentationInnovation1 -->
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

    <h1>Documentation innovation 1</h1>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">En quoi consiste cette innovation ? En quoi est-elle originale ?</div>
      <div class="panel-body">
        Il s'agit d'une innovation portant sur des statistiques. Elle permet de voir le classement d'un centre par rapport aux autres selon le nombre d'injections qu'il a réalisé sur ces patients. Ce classement est réalisé pour chaque type de vaccin, car un centre peut être spécialisé dans l'injection d'un seul type de vaccin mais ne pas en faire d'autre. Afin de ne pas surcharger l'affichage, on demande à l'utilisateur de sélectionner le centre dont il souhaite voir ces informations de classement, puis une page s'ouvre avec les différentes donné, où chaque ligne correspond à un type de vaccin déjà injecté. De plus, sur cette affichage, nous pouvons y voir le nombre d'injections réalisé par type de vaccin ainsi que le classement associé a ce notre de doses par rapport aux autres centres. Cela instaure de la rivalité entre les différents centre, pour qu'ils fassent la compétition de qui aura vacciné le plus de personnes.  
      </div>
    </div>
    <br>

    <div class="panel panel-primary">
      <div class="panel-heading">Comment fonctionne-t-elle ?</div>
      <div class="panel-body">
        L'utilisateur clique sur l'onglet Documentation>Innovation 1, puis la donné action = "innovationSelectCentre" permet de se rediriger vers le ControllerInnovation qui récupère l'ensemble des centres pour demander à l'utilisateur sous les trait d'un formulaire quel centre veut-il voir son classement, et la somme des injections qu'il a réalisé. Le formulaire possède comme nom idCentre et chaque option du select possède la valeur de l'identifiant du centre associé. L'utilisateur sélectionne alors un des centre, qui transmet l'identifiant du centre. Le formulaire possède un input hidden avec comme valeur innovation1Classement qui permet de repasser par le router puis appeler la méthode innovation1Classement du ControllerInnovation. Cette méthode du controller appelle une méthode du modèle innovation1NbInjection() qui permet d'organiser chaque somme d'injection par type de vaccin regroupé par centre et de les organiser de celui qui a fait le plus d'injection a celui qui en a fait le moins et cela pour tout centre confondu. Cette méthode permet de calculer la somme des doses injectés aux patient dans chacun des centres selon le type du vaccin. Puis permet de classer l'ensemble des centres entre eux selon cette sommes et par type de vaccin. Les tuples sont organisé du plus grand nombre d'injection aux moins grand nombre et cela pour chaque vaccin. On retourne ensuite dans le controller, qui permet d'analyser et d'extraire uniquement ce que l'on a besoin. On parcours l'ensemble des donné récupéré, on regarde si on change de vaccin, si c'est le cas alors on redémare la numérotation du classement à 1 désignant le centre avec le plus d'injections de ce vaccin, puis a chaque itération de la boucle on incrémente le numéro de ligne qui correspond au classement du centre selon son nombre d'injection. S'il s'agit d'un tuple associé au centre que l'on souhaite récupérer ces informations alors on le stocke dans le tableau $results qui sera par la suite affiché par la viewInnovation1. On a dû utiliser un indexResults pour remplir progressivement le table $results dans l'ordre sans faire de saut. $numLigne désigne l'évolution du classement des centres pour un type de vaccin.
      </div>
    </div>
    <br>




  <?php
  ///on affiche le bas de page
  include $root . '/app/view/fragment/fragmentVaccinFooter.html'; 
  ?>

  <!-- ----- fin viewDocumentationInnovation1 -->
  
  
  