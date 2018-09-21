<?php
require 'connect.php';
require 'authenticate.php';

require 'php-image-resize-master\lib\ImageResize.php';

use \Eventviva\ImageResize;
    // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);

       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];

       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }
    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png', 'JPG'];

        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];

        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);

        return $file_extension_is_valid && $mime_type_is_valid;
    }

    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);
    if ($image_upload_detected) {

        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];

        $new_image_path        = file_upload_path($image_filename);

         if (file_is_an_image($temporary_image_path, $new_image_path)) {

             move_uploaded_file($temporary_image_path, $new_image_path);

             $image = basename($image_filename);

             $imageResize = new ImageResize($new_image_path);
             $imageResize->resizeToBestFit(150,250);
             $imageResize->save($new_image_path);

             $title = $_POST['booksTitle'];

             $sql = 'UPDATE book SET Image = :image WHERE Title = :title';

             // Prepares the sql statement for the database and binds the values
             $statement = $db->prepare($sql);
             $statement->bindValue(':title', $title);
             $statement->bindValue(':image', $image);

             // Executes the sql statement and redirects the user to the index page
             $statement->execute();

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

    <form method='post' enctype='multipart/form-data'>
        <label for='image'>Add Picture:</label>
        <input type='file' name='image' id='image'>
        <input type="text" placeholder="Book Name">
        <input type='submit' name='submit' value='Upload Image'>
        <select name="booksTitle">
          <option value="Pride and Prejudice"> Pride and Prejudice </option>
          <option value="Le Petit Prince"> Le Petit Prince</option>
          <option value="Bible"> Bible </option>
          <option value="Harry Potter"> Harry Potter </option>
        </select>
    </form>

  </body>

</html>
