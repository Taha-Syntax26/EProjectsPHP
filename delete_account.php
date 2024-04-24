<?php
require 'Connection/connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        try {
            // Establish the database connection
            // Include your database connection code here

            // Execute a query to delete the user's account based on their email
            $delete_query = "DELETE FROM `register` WHERE email = :email";
            $delete_prepare = $connection->prepare($delete_query);
            $delete_prepare->bindValue(":email", $email);
            $delete_prepare->execute();

            // Additional clean-up or related actions can be added here

            // Clear the session after account deletion
            // session_unset();
            // session_destroy();
            require_once 'logout.php';
            // Send a success response
            http_response_code(200); // Indicate successful account deletion
            exit();
        } catch (PDOException $e) {
            // Handle database errors
            http_response_code(500); // Internal server error
            exit("Database error: " . $e->getMessage());
        }
    } else {
        http_response_code(400); // Bad request
        exit("Session data not found");
    }
} else {
    http_response_code(405); // Method not allowed
    exit("Invalid method. This endpoint accepts only POST requests.");
}
?>
