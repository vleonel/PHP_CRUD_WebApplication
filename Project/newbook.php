<?php

	require 'authenticate.php';
	require 'connect.php';

  if($_POST)
  {
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $pubName = trim(filter_input(INPUT_POST, 'pubName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $pubDate = trim(filter_input(INPUT_POST, 'pubDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $genre = trim(filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if(strlen($title) < 1 ||
       strlen($pubName) < 1 ||
       strlen($pubDate) < 1 ||
       strlen($genre) < 1)
       {
         header('Location: home.php');
       }
     else {
       $sql = "INSERT INTO book (Title, PubName, PubDate, Genre)
               VALUES (:title, :pubName, :pubDate, :genre)";
               $statement = $db->prepare($sql);

       $binds = ['title' => $title, 'pubName' => $pubName, 'pubDate' => $pubDate,
                 'genre' => $genre];
       $statement->execute($binds);


     }
  }

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <title> Bibliothèque publique française de Winnipeg </title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   </head>
   <body>
		 <nav class="navbar navbar-default">
		 <div class="navbar-header">
     <h1><a class="navbar-brand" href="home.php">Bibliothèque publique française de Winnipeg</a></h1>
     <form method="post">
			 </div>
			 </nav>
       <p><label for="title">Title:</label></p>
       <input type="text" id="title" name="title" placeholder="Title of the book">
       <p><label for="pubName">Publisher's Name:</label></p>
       <input type="text" id="pubName" name="pubName" placeholder="Publisher's Name">
       <p><label for="pubDate">Publisher's Date:</label></p>
       <input type="text" id="pubDate" name="pubDate" placeholder="Publisher's Date">
       <p><label for="genre">Genre:</label></p>
       <input type="text" id="genre" name="genre" placeholder="Genre">


       <p><input type="submit" value="Add new book!"></p>

     </form>
   </body>
 </html>
