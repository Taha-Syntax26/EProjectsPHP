
<?php
// Include your database connection
include_once('Connection/connection.php');

// Fetch all categories
$category_query_diff = "SELECT * FROM `category`";
$category_prepare_diff = $connection->prepare($category_query_diff);
$category_prepare_diff->execute();
$category_data_diff = $category_prepare_diff->fetchAll(PDO::FETCH_ASSOC);

foreach ($category_data_diff as $data) {
    echo '<tr>';
    echo '<td>' . $data['category_name'] . '</td>';
    echo '<td style="width:20%;">';
    echo '<form method="post" class="toggle-visibility-form">';
    echo '<input type="hidden" class="cg_id" value="' . $data['category_id'] . '">';
    echo '<button type="submit" class="btn toggle-visibility" name="toggle_visibility">';
    echo ($data['is_visible'] == 1) ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>';
    echo '</button>';
    echo '</form>';
    echo '</td>';
    echo '<td style="width:20%;">';
    echo '<form method="post" class="delete-form">';
    echo '<input type="hidden"  class="del_id" value="' . $data['category_id'] . '">';
    echo '<button type="submit" class="btn">';
    echo '<i class="fa-solid fa-trash h4" style="color: #e23232;"></i>';
    echo '</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
?>







 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function () {
    // Use a class for the form and the button
    $(".toggle-visibility-form").submit(function (event) {
        event.preventDefault();
        let cg_id = $(this).find('.cg_id').val(); // Use $(this) to reference the current form

        // Send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'visibile.php',
            data: {
                cg_id: cg_id
            },
            success: function (response) {
                // console.log(cg_id);
                $('#collapseUtilities .collapse-inner').load('get_category_links.php');
                $('#category-table-body').load('get_category_table.php');
                // You may want to update the table body or perform other actions here
            }
        });
    });
});







  $(document).ready(function () {
    // Use a class for the form and the button
    $(".delete-form").submit(function (event) {
        event.preventDefault();
        let del_id = $(this).find('.del_id').val(); // Use $(this) to reference the current form

        // Send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'delete_category.php',
            data: {
                del_id: del_id
            },
            success: function (response) {
                // console.log(del_id);
                   $('#collapseUtilities .collapse-inner').load('get_category_links.php');
                   $('#category-table-body').load('get_category_table.php');
                // You may want to update the table body or perform other actions here
            }
        });
    });
});

</script>






