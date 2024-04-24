


<?php include "Connection/connection.php" ?>




<?php
$product_name = null;
$status = null;
?>

<?php

    // Retrieve form data
    $product_name = $_POST["pro_name"]; // Note the capitalization
    $status = $_POST["pro_status"];

    // Assuming you have established a database connection earlier
    $insert_query = "INSERT INTO `category`(`category_name`, `is_visible`) VALUES (:category_name, :category_status)";
    $insert_query_prepare = $connection->prepare($insert_query);
    
    // Use bindValue to bind the parameters
    $insert_query_prepare->bindValue(':category_name', $product_name, PDO::PARAM_STR);
    $insert_query_prepare->bindValue(':category_status', $status, PDO::PARAM_STR);

    $insert_query_prepare->execute();

    // Redirect or display a success message
    header("Location: add_category.php");
     // Redirect to a success page
    exit;

?>


