
<!-- ----- debut ControllerDocumentation -->
<?php

class ControllerDocumentation {

  public static function documentationAvis() {
    include 'config.php';
    $vue = $root . '/app/view/documentation/viewAvis.php';
    require ($vue);
  }

  public static function documentationInnovation1() {
    include 'config.php';
    $vue = $root . '/app/view/documentation/viewDocumentationInnovation1.php';
    require ($vue);
  }

  public static function documentationInnovation2() {
    include 'config.php';
    $vue = $root . '/app/view/documentation/viewDocumentationInnovation2.php';
    require ($vue);
  }

  public static function documentationInnovation3() {
    include 'config.php';
    $vue = $root . '/app/view/documentation/viewDocumentationInnovation3.php';
    require ($vue);
  }

}

?>
<!-- ----- fin ControllerDocumentation -->


