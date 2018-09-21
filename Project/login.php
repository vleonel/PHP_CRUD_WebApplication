<?php
require 'connect.php';

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['email']) || empty($_POST['password'])) {
$error = "Email or Password is invalid";
}
else
{
// Define $email and $password
$email=trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$password=trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

// Select book table and order by Publish Date
$sql = 'SELECT * FROM donor WHERE Email = :email';
$statement = $db->prepare($sql);
$statement->bindValue(':email', $email);

// Executes the sql statement and redirects the user to the index page
$statement->execute();

$rows = $statement->fetch();
// echo $rows;
if (password_verify($password, $rows['Password'])) {
$_SESSION['login_user']=$email; // Initializing Session
header("location: home.php"); // Redirecting To Other Page
} else {
$error = "Email or Password is invalid";
}
// mysql_close($connection); // Closing Connection
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
          <a class="navbar-brand" href="">Bibliothèque publique française de Winnipeg</a>
        </div>
      </div>
    </nav>

    <form class="navbar-form navbar-left" method="post" role="search">
  <div class="form-group">
    <input type="text" name="email" class="form-control" placeholder="Email">
    <input type="password" name="password" class="form-control" placeholder="Password">
  </div>
  <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
