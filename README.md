# PDO PHP Activity

This project demonstrates how to use PHP Data Objects (PDO) to interact with a MySQL database and fetch records from a `Transactions` table.

# Output

<img src="https://github.com/user-attachments/assets/4a488c11-a159-41c6-ac87-cfecde20d59e" alt="Example Output" width="1000" />

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

