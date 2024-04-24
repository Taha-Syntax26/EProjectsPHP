<?php include "Connection/connection.php" ?>

<?php
$product_unique_id = null;
$product_name = null;
$username = null;
$date = null;
$testing_type  = null;
$desc = null;


$product_unique_id = $_POST['productUniqueId'];
$product_name = $_POST['productName'];
$username = $_POST['username'];
$date = $_POST['date'];
$testing_type = $_POST['testingtype'];
$desc = $_POST['desc'];

$insert_query = "INSERT INTO `testing_forms`(`product_name`,`product_unique_id`,`username`, `date`, `testing_type`, `description`) VALUES (:product_name,:product_unique_id,:username, :date, :testing_type, :desc)";
$insert_query_prepare = $connection->prepare($insert_query);

$insert_query_prepare->bindParam(':product_unique_id', $product_unique_id, PDO::PARAM_INT);
$insert_query_prepare->bindParam(':product_name', $product_name, PDO::PARAM_STR);
$insert_query_prepare->bindParam(':username', $username, PDO::PARAM_STR);
$insert_query_prepare->bindParam(':date', $date, PDO::PARAM_STR);
$insert_query_prepare->bindParam(':testing_type', $testing_type, PDO::PARAM_STR);
$insert_query_prepare->bindParam(':desc', $desc, PDO::PARAM_STR);

$insert_query_prepare->execute();



?>

