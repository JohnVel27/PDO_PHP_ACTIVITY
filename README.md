# PDO PHP ACTIVITY

## Selecting All Transaction from the table

```php
// Prepare and execute the SQL query to fetch all records from the Transactions table
$stmt_all = $conn->query("SELECT * FROM Transactions");

// Fetch all rows as an associative array
$rows = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

// Display all results inside <pre> tag using print_r for better readability
echo "<pre>";
print_r($rows);
echo "</pre>";
  


This code snippet is fetching all the records from the transactions table in a database and displaying them in a human-readable format using the print_r() function inside a <pre> tag.

## Selecting Single transaction from the table


```php
// Prepare and execute the SQL query to fetch all records from the Transactions table
$stmt_all = $conn->query("SELECT * FROM Transactions");

// Fetch all rows as an associative array
$rows = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

// Display all results inside <pre> tag using print_r for better readability
echo "<pre>";
print_r($rows);
echo "</pre>";


This code fetches one record from a table and displays it clearly on the page.

# OUTPUT

<img src="https://github.com/user-attachments/assets/4a488c11-a159-41c6-ac87-cfecde20d59e" alt="Description of the image" width="1000" />
