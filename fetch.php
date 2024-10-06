<?php
// Start the session
session_start();

// Require the database configuration file
require 'dbconfig.php';  

try {
    // First, let's demonstrate fetch() - fetching a single record
    echo "<h2>Single Record Fetch (fetch())</h2>";
    
    // Prepare and execute the SQL query to fetch one record from the Transactions table
    $stmt = $conn->query("SELECT * FROM Transactions LIMIT 1");

    // Fetch a single row as an associative array
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display the result inside <pre> tag using print_r for better readability
    echo "<pre>";
    print_r($row);
    echo "</pre>";

    // Now, let's demonstrate fetchAll() - fetching all records
    echo "<h2>All Records Fetch (fetchAll())</h2>";
    
    // Prepare and execute the SQL query to fetch all records from the Transactions table
    $stmt_all = $conn->query("SELECT * FROM Transactions");

    // Fetch all rows as an associative array
    $rows = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

    // Display all results inside <pre> tag using print_r for better readability
    echo "<pre>";
    print_r($rows);
    echo "</pre>";
} catch (PDOException $e) {
    // Handle any query errors
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
