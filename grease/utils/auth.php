<?php

class Auth {

  public static function check($user = 'vis') {
    if (!isset($_SESSION['usuario'])) {
      header('Location: '. $_ENV['VIEWS'] .'/auth/login.php');
    }

    if (!$_SESSION['usuario']['tipo_usuario'] === $user) {
      header('Location: '. $_ENV['VIEWS'] .'/auth/login.php');
    }
  }

}

?>