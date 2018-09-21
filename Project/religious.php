<?php
  require 'connect.php';

  // Select book table and order by Publish Date
  $sql = 'SELECT * FROM book WHERE Genre = "Religious"';
  $statement = $db->prepare($sql);
  $statement->execute();

  // Update command for sql
  // $sql = 'UPDATE book SET Image = null WHERE Title = :title';

  // Prepares the sql statement for the database and binds the values
  // $statement = $db->prepare($sql);
  // $statement->bindValue(':title', $title);

  // Executes the sql statement and redirects the user to the index page
  // $statement->execute();
  // header('Location: home.php');

  // $sql = "DELETE FROM book WHERE BookId = :id";
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

    <?php while ($row = $statement->fetch()): ?>
    <div class ="bookimage col-lg-1">
       <img src="uploads/<?= $row['Image']?>" />
    </div>
      <div class="bookcontent col-lg-4">
      <ul>
        <li> <?= $row['Title'] ?><a href="edit.php?id=<?= $row['BookId'] ?>" > Edit</a> </li>
        <li> <?= $row['PubName'] ?></li>
        <li> <?= $row['PubDate'] ?> </li>
        <li> <?= $row['Genre'] ?> </li>
        <!-- <input type="submit" name="command" value="Delete" onclick="return confirm('Do you want to delete this book?')" > -->
      </ul>
    </div>
    <?php endwhile ?>
  </body>

</html>
