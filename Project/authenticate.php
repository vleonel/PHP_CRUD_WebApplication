<?php
  // This authenticates the user to allow access to CUD
  define('ADMIN_LOGIN','rick');
  define('ADMIN_PASSWORD','rickroll');
  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)
      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Only authorized people"');
    exit("Access Denied: Username and password required.");
  }

?>
