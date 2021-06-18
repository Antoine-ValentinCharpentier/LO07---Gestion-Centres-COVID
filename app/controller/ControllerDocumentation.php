
<!-- ----- debut ControllerDocumentation -->
<?php

class ControllerDocumentation {

  public static function documentationAvis() {
    include 'config.php';
    $vue = $root . '/app/view/documentation/viewAvis.php';
    require ($vue);
  }

}

?>
<!-- ----- fin ControllerDocumentation -->


