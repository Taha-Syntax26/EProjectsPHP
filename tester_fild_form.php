<?php include "Connection/connection.php" ?>

<?php
$product_unique_id = null;
$product_testing_id = null;
$uploader_name = null;
$product_name = null;
$date = null;
$testing_type = null;
$rating = null;
$result = null;
$remarks = null;
$desc = null;

$product_unique_id = $_POST['Product_unique_id'];
$product_testing_id = $_POST['Product_testing_id'];
$uploader_name = $_POST['Uploader_name'];
$product_name = $_POST['Product_name'];
$date = $_POST['Date'];
$testing_type = $_POST['Testing_type'];
$rating = $_POST['Rating'];
$result = $_POST['Result'];
$remarks = $_POST['Remarks'];
$desc = $_POST['Desc'];

$insert_query = "INSERT INTO `tested_product`(`product_name`, `product_unique_id`, `product_testing_id`, `uploader_name`, `prod_date`, `result`, `testing_type`, `rating`, `remarks`, `description`) VALUES (:product_name, :product_unique_id, :product_testing_id, :uploader_name, :prod_date, :result, :testing_type, :rating, :remarks, :description)";
$insert_query_prepare = $connection->prepare($insert_query);

$insert_query_prepare->bindValue(':product_name', $product_name, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':product_unique_id', $product_unique_id, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':product_testing_id', $product_testing_id, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':uploader_name', $uploader_name, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':prod_date', $date, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':testing_type', $testing_type, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':rating', $rating, PDO::PARAM_INT);
$insert_query_prepare->bindValue(':result', $result, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':remarks', $remarks, PDO::PARAM_STR);
$insert_query_prepare->bindValue(':description', $desc, PDO::PARAM_STR);
$insert_query_prepare->execute();

$delete_product_query = "DELETE FROM testing_forms WHERE id = :id";
$delete_product_prepare = $connection->prepare($delete_product_query);
$delete_product_prepare->bindParam(':id', $prod_id_get);
$delete_product_prepare->execute();
?>
