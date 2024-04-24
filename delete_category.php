<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
require 'Connection/connection.php';
?>

<?php 
// delete_category.php

// Check if the form is submitted and the category ID is set

    // Assuming you have established a database connection earlier
    // Retrieve the category ID from the form
    $category_id = $_POST['del_id'];

    // Prepare the delete query
    $delete_query = "DELETE FROM `category` WHERE `category_id` = :category_id";
    $delete_query_prepare = $connection->prepare($delete_query);

    // Bind the category ID parameter
    $delete_query_prepare->bindValue(':category_id', $category_id, PDO::PARAM_INT);

    // Execute the delete query
    $delete_query_prepare->execute();



?>