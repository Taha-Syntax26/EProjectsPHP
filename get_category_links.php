<?php
// Include your database connection
include_once('Connection/connection.php');

// Fetch visible categories
$category_query = "SELECT * FROM `category` where `is_visible` = 1";
$category_prepare = $connection->prepare($category_query);
$category_prepare->execute();
$category_data = $category_prepare->fetchAll(PDO::FETCH_ASSOC);

// Output the dynamically generated anchor links
foreach ($category_data as $data) {
    echo '<a class="collapse-item" href="forms.php?name=' . $data['category_name'] . '">' . $data['category_name'] . '</a>';
}
?>





        <!-- ___Ajax Work___ -->

        <script>

// For Loading body data when clickng on navbar links

$(document).ready(function() {
    function initializeEventHandlers() {


        
        $('.collapse-item').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior

        var page = $(this).attr('href'); // Get the URL from the href attribute

  // Use the History API to update the URL
        history.pushState(null, null, page);

  // Load the content into the #wrapper element
       $('#page-top').load(page, function(response, status, xhr) {
       if (status === 'success') {
      // Content loaded successfully
       }else if (status === 'error') {
      // Handle any loading errors
      alert('Error loading the page: ' + xhr.status + ' ' + xhr.statusText);
    }
  });
});


         

    }

    // Initialize the event handlers when the page loads:
    initializeEventHandlers();
});


</script>
