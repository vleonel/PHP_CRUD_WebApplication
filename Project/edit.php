<?php
  require 'authenticate.php';
  require 'connect.php';

  // Sanitizes the get input for id to be an int
	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  if (is_numeric($id))
	{
		// sql statement getting the data from the id
		$sql = 'SELECT * FROM book WHERE BookId = :id';
		$statement = $db->prepare($sql);

		$binds = ['id' => $id];
		$statement->execute($binds);

    $bookPost = $statement->fetch();
	}
  else
	{
		// Redirects user to index
	 	header('Location: home.php');
	}

  // Checks if there is a post
	if ($_POST)
	{
		// Sanitizes the post input for id to be an int
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

		// Checks if the update button was clicked
		if ($_POST['command'] == "Update")
		{

			$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
			$pubName = trim(filter_input(INPUT_POST, 'pubName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $pubDate = trim(filter_input(INPUT_POST, 'pubDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $genre = trim(filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $image = trim(filter_input(INPUT_POST, 'Image', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

			// Checks if the string length are empty.
			if (strlen($title) < 1 || strlen($pubName) < 1 ||
          strlen($pubDate) < 1 || strlen($genre) < 1 )
			{
				// Sends the user to an error page
				header('Location: home.php');
			}
			// Checks if there is something inside title and post
			else
			{
				// Update command for sql
				$sql = 'UPDATE book SET Title = :title, PubName = :pubName,
                PubDate = :pubDate, Genre = :genre, Image = :image
                WHERE BookId = :id';

				// Prepares the sql statement for the database and binds the values
				$statement = $db->prepare($sql);
				$statement->bindValue(':title', $title);
				$statement->bindValue(':pubName', $pubName);
        $statement->bindValue(':pubDate', $pubDate);
        $statement->bindValue(':genre', $genre);
        $statement->bindValue(':image', $image);
				$statement->bindValue(':id', $id);

				// Executes the sql statement and redirects the user to the index page
				$statement->execute();
				header('Location: home.php');
			}
    }
    else if($_POST['command'] == "Delete")
		{
			// Delete command for sql
			$sql = "DELETE FROM book WHERE BookId = :id";

			// Prepares the sql statement for the database and binds the value
			$statement = $db->prepare($sql);
			$statement->bindValue(':id', $id);

			// Executes the sql statement and redirects the user to the index page
			$statement->execute();
			header('Location: home.php');
		}
    else {
      // Delete command for sql
			$sql = "UPDATE book SET Image = NULL WHERE BookId = :id";

			// Prepares the sql statement for the database and binds the value
			$statement = $db->prepare($sql);
			$statement->bindValue(':id', $id);

			// Executes the sql statement and redirects the user to the index page
			$statement->execute();

      $fileName = $bookPost['Image'];
      $subfolder = "uploads";
      $currentFolder = dirname(__FILE__);

      $arrayImage = [$currentFolder, $subfolder, $fileName ];

      $filePath = join(DIRECTORY_SEPARATOR, $arrayImage);


      if(is_writable($filePath))
      {
        unlink($filePath);
      }
			header('Location: home.php');
    }
	}



 ?>
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

     <h1><a href="home.php">Bibliothèque publique française de Winnipeg</a></h1>
     <form method="post">
       <p><label for="title">Title:</label></p>
       <input type="text" id="title" name="title" value="<?= $bookPost['Title'] ?>" placeholder="Title of the book">
       <p><label for="pubName">Publisher's Name:</label></p>
       <input type="text" id="pubName" name="pubName" value="<?= $bookPost['PubName'] ?>"placeholder="Publisher's Name">
       <p><label for="pubDate">Publisher's Date:</label></p>
       <input type="text" id="pubDate" name="pubDate" value="<?= $bookPost['PubDate'] ?>" placeholder="Publisher's Date">
       <p><label for="genre">Genre:</label></p>
       <input type="text" id="genre" name="genre" value="<?= $bookPost['Genre'] ?>" placeholder="Genre">
       <p><label for="genre">Image:</label></p>
       <input type="text" id="image" name="image" value="<?= $bookPost['Image'] ?>" placeholder="Image">
       <input type="hidden" name="id" value="<?= $bookPost['BookId'] ?>">
       <p><button name="command" type="submit" value="Update">Update</button>
       <input type="submit" name="command" value="Delete" onclick="return confirm('Do you want to delete this book?')" >
       <input type="submit" name="command" value="DeletePicture" onclick="return confirm('Do you want to delete this picture?')" >
       </p>

     </form>

   </body>
 </html>
