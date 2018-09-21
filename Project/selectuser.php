<?php
  require 'connect.php';

    // Sanitizes the get input for id to be an int
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    //$id = 6;

    $sql = "SELECT * FROM donor WHERE DonorId = :id";
    $statement = $db->prepare($sql);

    $binds = ['id' => $id];
    $statement->execute($binds);

    $row = $statement->fetch();

    $donorPost["name"] = $row["FullName"];
    $donorPost["email"] = $row["Email"];
    $donorPost["phone"] = $row["Phone"];
    $donorPost["id"] = $row["DonorId"];

    // Encode in a method and send it back
    echo json_encode($donorPost);

 ?>
