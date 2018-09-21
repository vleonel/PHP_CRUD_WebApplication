<?php
  require("connect.php");

  // Initiate session
  session_start();

// declare email and password
  $email = "";
  $password = "";

  $user = "";
  $error = "";

  $is_admin = false;

  if (isset($_POST["submit"])) {
    if ($_POST && isset($_POST["email"]) && isset($_POST["password"])) {

      $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      if (strlen($email)>0 && strlen($password)>0) {
        $query = "SELECT * FROM donor WHERE Email = :email LIMIT 1";
        $statement = $db -> prepare($query);
        $statement -> bindvalue(":email", $email);
        $statement -> execute();
        $user = $statement -> fetch();

        $hash = $user["password"];

        if (password_verify($password, $hash)) {
          $_SESSION["username"] = $user["username"];
          $_SESSION["security"] = $user["security"];
          header("Location: home.php");
          exit;
        }
        else {
          $error = "Username or password are not correct!";
        }
      }
      else {
        $error = "Username or password cannot be empty!";
      }
    }
  }

?>
