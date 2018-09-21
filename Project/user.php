<?php
  require 'authenticate.php';
  require 'connect.php';

  if($_POST)
  {
    $fullName = trim(filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  if(strlen($fullName) < 1 ||
     strlen($email) < 1 ||
     strlen($phone) < 1 ||
     strlen($password) < 1)
     {
      echo $fullName;
      echo $email;
      echo $phone;
      echo $password;
     }
     else {
       $sql = "INSERT INTO donor (FullName, Email, Phone, Password)
               VALUES (:fullName, :email, :phone, :password)";
               $statement = $db->prepare($sql);

       $hashAndSalt = password_hash($password, PASSWORD_BCRYPT);

       $binds = ['fullName' => $fullName, 'email' => $email, 'phone' => $phone,
                 'password' => $hashAndSalt];
       $statement->execute($binds);
       header('Location: home.php');
     }
   }
?>
<!DOCTYPE html>
<html>
  <head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <style>
    .form-control
    {
      display: inline-block;
    }
  </style>
    <title> Bibliothèque publique française de Winnipeg </title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="home.php">Bibliothèque publique française de Winnipeg</a>
        </div>
      </div>
    </nav>

    <form method="post">
      <p><label for="fullName">Full Name:</label></p>
      <input type="text" id="fullName" name="fullName" placeholder="Name of the donor">
      <p><label for="email">Email:</label></p>
      <input type="text" id="email" name="email" placeholder="Donor's email">
      <p><label for="phone">Phone:</label></p>
      <input type="text" id="phone" name="phone" placeholder="e.g 2045992768">
      <p><label for="password">Password:</label></p>
      <input type="password" id="password" name="password" placeholder="A1B2D3">
      <p><input type="submit" value="Register!"></p>
   </body>
