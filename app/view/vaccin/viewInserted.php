
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentVaccinHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentVaccinMenu.html';
    include $root . '/app/view/fragment/fragmentVaccinJumbotron.html';

    if ($results != -1) {
        //si on a réussi a insérer le vaccin, alors on affiche ces informations
        echo ("<h3>Le nouveau vaccin a été ajouté </h3>");?>
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
            printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>", $results, $_GET['label'], $_GET['doses']);
            ?>
            </tbody>
        </table>

<?php
    }else {
        //si on n'a pas réussis a insérer le vaccin
        echo ("<h3>Problème lors de l'insertion du vaccin</h3>");
        echo ("Assurez-vous que le champ label '" . $_GET['label']."' n'est pas déjà utilisé par un autre vaccin.");
    }
    echo("</div>");

include $root . '/app/view/fragment/fragmentVaccinFooter.html';
?>
<!-- ----- fin viewInserted -->    

    
    