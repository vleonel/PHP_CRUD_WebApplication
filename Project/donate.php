<?php
  session_start();
  //require 'captcha.php';

  require 'connect.php';

   if($_POST)
   {
     $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
     $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
     $comment= trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
     if(strlen($email) < 1 || strlen($comment) < 1 )
     {
       header('Location: home.php');
     }
     else {


        $sql = "INSERT INTO comment (Name, Email, Comment)
                VALUES (:name, :email, :comment)";
               $statement = $db->prepare($sql);

       $binds = ['name' => $name, 'email' => $email, 'comment' => $comment];
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
  <!-- <script src="js/jquery.js"></script> -->
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <style>
    .form-control
    {
      display: inline-block;
    }

    .captcha
    {
      display: block;
    }
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

     <div id="contactForm" class="col-sm-6 col-sm-offset-3">

			<h2>Are you looking for any book?</h2>
		 <form method="post">
       <div class="form-group col-sm-5">
			  <label>Name:</label>
				<input type="text" id="name" name="name" />
      </div>
      <div class="form-group col-sm-5">
				<label>Email:</label>
				<input type="text" id="email" name="email" />
      </div>
      <div class="form-group col-sm-6">
				<label></label><br />
				<textarea name="comment" id="comment" rows="10" cols="50"></textarea>
				<input type="submit" />
       </div>
			</form>
    </div>
  </body>
</html>
