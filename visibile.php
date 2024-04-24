
<?php
require 'Connection/connection.php';
?>




<?php
 $categoryId = null;
 
 
 
 
 
 
 // Retrieve category ID from the form
 $categoryId = $_POST["cg_id"];

       

        // Get the current visibility status of the category from the database
        $get_visibility_query = "SELECT `is_visible` FROM `category` WHERE `category_id` = :category_id";
        $get_visibility_query_prepare = $connection->prepare($get_visibility_query);
        $get_visibility_query_prepare->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $get_visibility_query_prepare->execute();
        $current_visibility = $get_visibility_query_prepare->fetchColumn();

        // Toggle visibility status
        $new_visibility = ($current_visibility == 1) ? 0 : 1;

        // Update visibility status in the database
        $update_visibility_query = "UPDATE `category` SET `is_visible` = :new_visibility WHERE `category_id` = :category_id";
        $update_visibility_query_prepare = $connection->prepare($update_visibility_query);
        $update_visibility_query_prepare->bindValue(':new_visibility', $new_visibility, PDO::PARAM_INT);
        $update_visibility_query_prepare->bindValue(':category_id',   $categoryId, PDO::PARAM_INT);
        $update_visibility_query_prepare->execute();

      
    ?>
