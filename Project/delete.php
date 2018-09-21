<?php
  require 'connect.php';
  require 'authenticate.php';

  if ($_GET)
	{
		// Sanitizes the post input for id to be an int
		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

      // Delete command for sql
			$sql = "DELETE FROM Comment WHERE CommentId = :id";

			// Prepares the sql statement for the database and binds the value
			$statement = $db->prepare($sql);
			$statement->bindValue(':id', $id);

			// Executes the sql statement and redirects the user to the index page
			$statement->execute();
			header('Location: home.php');

  }
?>
