<?php
require 'connect.php';


if(isset($_GET["search"]))
{
    $search = $_GET["search"];

  if(strlen($search)>0){

    if( $_GET["search"]){
      $query = "SELECT *
                FROM book
                WHERE (title LIKE '%$search%')";
    }

  $statement = $db -> prepare($query);
  $statement -> execute();
  $posts = $statement -> fetchAll();
}
}

 ?>
<!DOCTYPE html>
<html>
 <head>
  <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="jquery-3.1.1.min.js."></script>
 <!-- Optional theme -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<style>
  .table{
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Bibliothèque publique française de Winnipeg</a>
    </div>
  </div>
</nav>
   <style>
     table{
       border: 1px;
       width: 100%;
       border-spacing: 5px;
     }
   </style>
   <div class="row">
     <div class = "col-lg-2">
       <?php foreach($posts as $post ): ?>
         <table class="table">
           <th>
             <?= $post['Title'] ?>
           </th>
           <tr>
             <td><mark>Writer: </mark><?= $post['PubName'] ?></td>
             <td><mark>Genre: </mark><?= $post['Genre'] ?></td>
             <td><mark>Published Date: </mark><?= $post['PubDate'] ?></td>
             <td>Available:<mark> YES </mark></td>
           </tr>
        </table>
      <?php endforeach ?>
   </div>
 </div>
</body>
 </html>
