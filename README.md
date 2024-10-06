# PDO PHP Activity

This Activity demonstrates how to use PHP Data Objects (PDO) to interact with a MySQL database and insertion,deletion,updating and fetching records from a `Transactions` table.

# INSERTION OF RECORD


## Output of fetching

<img src="https://github.com/user-attachments/assets/bc9e11fd-705f-4ccf-a4a2-a0a0df71344d" alt="Sample Image" width="100%" height="auto">

## Fetching All Transactions and Single Transaction from the Table

```php
// Prepare and execute the SQL query to fetch all records from the Transactions table
$stmt_all = $conn->query("SELECT * FROM Transactions");

// Fetch all rows as an associative array
$rows = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

// Display all results inside <pre> tag using print_r for better readability
echo "<pre>";
print_r($rows);
echo "</pre>";


// Prepare and execute the SQL query to fetch one record from the Transactions table
$stmt = $conn->query("SELECT * FROM Transactions LIMIT 1");

// Fetch a single row as an associative array
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Display the result inside <pre> tag using print_r for better readability
echo "<pre>";
print_r($row);
echo "</pre>";

