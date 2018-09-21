
<?php
require 'connect.php';

session_start();

// sql statement to select all the information in blog and orders by the date
$sql = 'SELECT * FROM comment';
$statement = $db->prepare($sql);
$statement->execute();

$count = 0;

// Select book table and order by Publish Date
// $sql = 'SELECT * FROM book ORDER BY PubDate';
// $statement = $db->prepare($sql);
// $statement->execute();

 ?>
<!DOCTYPE html>
<html>
  <head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="jquery-3.1.1.min.js."></script>
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- My jQuery-->
    <script>
      $(function(){
        $("#genre").animate({
          left: '250px',
          opacity: '0.5',
          height: '150px',
          width: '150px'
        });
      });

    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }
    </script>
  <style>
    .form-control
    {
      display: inline-block;
    }

    .news
    {
      text-align: center;
    }

    .genre
    {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: block;
    }

    body{
      background-color: #fff8dc;
    }


  </style>
    <title> Bibliothèque publique française de Winnipeg </title>
  </head>
  <body onload="startTime()">
    <!-- Navbar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="home">Bibliothèque publique française de Winnipeg</a>
          <div id="txt"></div>
          <form name="form1" method="get" action="searchresults.php">
            <input name="search" type="text" size="20" maxlength="20">
            <input type="submit" name="Submit" value="Search">

          </form>
        </div>
        <div class="collapse navbar-collapse" id="login">

          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['login_user'])): ?>
            <p><mark> Welcome: <?= $_SESSION['login_user']?> </mark></p>
          <?php else: ?>
            <!-- <li><a href="#">Email</a><input type="text" name="login" class="form-control"/></li>
            <li><a href="#">Password</a><input type="text" name="password" class="form-control"/></li> -->
            <li><a href="login.php">Sign In</a></li>
            <!-- Register for a login account by providing a username and a password -->
            <li><a href="register.php">Sign Up</a></li>

          <?php endif ?>

          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="contact.xml">About Us</a></li>
          <li><a href="donate.php">Donate</a></li>
          <li><a href="newbook.php">Add a new Book</a></li>
          <li><a href="addimage.php">Add a Image</a></li>
          <li><a href="user.php">Add User</a></li>
          <li><a href="ban.php">Ban</a></li>
        </ul>
      </div>
    </nav>
    <nav class="genre" id="genre">
			<ul>
				<li><a href="fantasy.php">Fantasy</a></li>
				<li><a href="religious.php">Religious</a></li>
				<!-- <li><a href="">Romance</a></li> -->
				<!-- <li><a href="">History</a></li> -->
			</ul>
		</nav>

    <nav class="news" id="test">
      <h2>Donor's comments: </h2>
      <?php if ($statement->rowCount() > 0): ?>
        <?php while ($row = $statement->fetch()): ?>
          <?php if ($count === 3) break ?>
          <p><?= $row['Comment'] ?> </p>
          <p><?= date('F j, Y') ?> - <a href="delete.php?id=<?= $row['CommentId'] ?>">delete</a></p>

          <?php $count++ ?>
        <?php endwhile ?>
        <?php else: ?>
          <p>No posts!</p>
      <?php endif ?>
    </nav>
    <style>
      .bookcontent{
        .col-lg-4
      }
    </style>

    <!-- <?php while ($row = $statement->fetch()): ?>
      <ul>
        <li> <?= $row['Title'] ?><a href="edit.php?id=<?= $row['BookId'] ?>" > Edit</a> </li>
        <li> <?= $row['PubName'] ?></li>
        <li> <?= $row['PubDate'] ?> </li>
        <li> <?= $row['Genre'] ?> </li>
      </ul>
    <?php endwhile ?> -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
