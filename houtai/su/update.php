<?php
// Connect to the database
$link = mysqli_connect("127.0.0.1", "root", "root", "database");

// Get the node's id and new name from the POST data
$id = $_POST["id"];
$name = $_POST["name"];

// Update the node's name in the database
$query = "UPDATE tree_lr SET name='" . mysqli_real_escape_string($link, $name) . "' WHERE id=" . intval($id);
mysqli_query($link, $query);

// Close the database connection
mysqli_close($link);
?>
