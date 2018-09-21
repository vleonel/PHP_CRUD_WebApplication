<?php
require 'connect.php';
require 'authenticate.php';
// Sanitizes the get input for id to be an int
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (is_numeric($id))
{
  // sql statement getting the data from the id
  $sql = 'SELECT * FROM donor WHERE DonorId = :id';
  $statement = $db->prepare($sql);

  $binds = ['id' => $id];
  $statement->execute($binds);

  $donorPost = $statement->fetch();

  print_r($donorPost);

if($_POST)
{
  if($_POST['command'] == "Delete")
  {
    // Delete command for sql
    $sql = "DELETE FROM donor WHERE DonorId = :id";

    // Prepares the sql statement for the database and binds the value
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $id);

    // Executes the sql statement and redirects the user to the index page
    $statement->execute();
    header('Location: home.php');
  }
  else if($_POST['command'] == "Update")
  {
    /*
      SMALL ERROR WITH MY UPDATE BUT ILL FIX IT I SWEAR
    */
    //  $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    //  $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    //  $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
     $name = "test";
     $email = "test";
     $phone = 2045992768;
    // Update command for sql
    $sql = 'UPDATE donor SET FullName = :name, Email = :email,
            Phone = :phone
            WHERE DonorId = :id';

            // Prepares the sql statement for the database and binds the values
            $statement = $db->prepare($sql);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':id', $id);

            echo $name;
            echo $email;

            $statement->execute();
    				//header('Location: home.php');
  }
}

}
 ?>
 <!DOCTYPE html>
 <html>
   <head>

  <script src="jquery-3.1.1.min.js."></script>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <!-- <script src="js/jquery.js"></script> -->
   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
   <script src="user.js"></script>
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
     <select name="donor" id="donor">
       <option value="6-Kyle Geske"> Kyle Geske </option>
       <option value="11-Matheu Plouffe"> Matheu Plouffe</option>
       <option value="8-Toshi Sama"> Toshi Sama </option>
     </select>
     <form method="post">
       <p><label for="Name">Name:</label></p>
       <input type="text" id="name" name="title" value="">
       <p><label for="Email">Email:</label></p>
       <input type="text" id="email" name="title" value="">
       <p><label for="Phone">Phone Number:</label></p>
       <input type="text" id="phone" name="title" value="">
       <input type="hidden" name="id" id="id" value="">
       <p><button name="command" type="submit" value="Update">Update</button>
       <input type="submit" name="command" value="Delete" onclick="return confirm('Do you want to delete this user?')" >
     </p>
     </form>
   </body>
  </html>
