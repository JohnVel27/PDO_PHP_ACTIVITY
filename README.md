# PDO PHP Activity

This Activity demonstrates how to use PHP Data Objects (PDO) to interact with a MySQL database and insertion,deletion,updating and fetching records from a `Transactions` table.

# INSERTING THE DATA

This PHP code facilitates the insertion of a new transaction into a database. It handles both the input form and the process of inserting the user's data into the Transactions table.

<pre>
  <code>
&lt;?php
// Include your database configuration file
require 'dbconfig.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input data
    $date = $_POST['date'];  
    $amount = $_POST['amount'];  
    $categoryID = $_POST['categoryID'];  
    $accountID = $_POST['accountID'];  
    $transactionTypeID = $_POST['transactionTypeID'];  
    $description = $_POST['description'];  

    // Prepare SQL INSERT statement
    $stmt = $conn-&gt;prepare("INSERT INTO Transactions (Date, Amount, CategoryID, AccountID, TransactionTypeID, Description) 
                             VALUES (:date, :amount, :categoryID, :accountID, :transactionTypeID, :description)");
    
    // Bind parameters
    $stmt-&gt;bindParam(':date', $date);
    $stmt-&gt;bindParam(':amount', $amount);
    $stmt-&gt;bindParam(':categoryID', $categoryID);
    $stmt-&gt;bindParam(':accountID', $accountID);
    $stmt-&gt;bindParam(':transactionTypeID', $transactionTypeID);
    $stmt-&gt;bindParam(':description', $description);
    
    // Execute the statement and check for success
    if ($stmt-&gt;execute()) {
        echo "Transaction inserted successfully!";
    } else {
        echo "Error inserting transaction: " . $stmt-&gt;errorInfo()[2];
    }
}

// Fetch categories, accounts, and transaction types from the database
$categories = $conn-&gt;query("SELECT CategoryID, CategoryName FROM categories")-&gt;fetchAll(PDO::FETCH_ASSOC);
$accounts = $conn-&gt;query("SELECT AccountID, AccountName FROM accounts")-&gt;fetchAll(PDO::FETCH_ASSOC);
$transactionTypes = $conn-&gt;query("SELECT TransactionTypeID, TransactionTypeName FROM transactiontypes")-&gt;fetchAll(PDO::FETCH_ASSOC);
?&gt;

&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Insert Transaction&lt;/title&gt;
    &lt;style&gt;
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;div class="container"&gt;
    &lt;h2&gt;Insert Transaction&lt;/h2&gt;
    &lt;form action="insert.php" method="POST"&gt;
        &lt;label for="date"&gt;Date:&lt;/label&gt;
        &lt;input type="date" id="date" name="date" required&gt;

        &lt;label for="amount"&gt;Amount:&lt;/label&gt;
        &lt;input type="number" id="amount" name="amount" required&gt;

        &lt;label for="description"&gt;Description:&lt;/label&gt;
        &lt;textarea id="description" name="description" rows="4" required placeholder="Enter transaction description"&gt;&lt;/textarea&gt;

        &lt;label for="categoryID"&gt;Category ID:&lt;/label&gt;
        &lt;select id="categoryID" name="categoryID" required&gt;
            &lt;option value=""&gt;Select Category&lt;/option&gt;
            &lt;?php foreach ($categories as $category): ?&gt;
                &lt;option value="&lt;?php echo $category['CategoryID']; ?&gt;"&gt;&lt;?php echo $category['CategoryName']; ?&gt; (ID: &lt;?php echo $category['CategoryID']; ?&gt;)&lt;/option&gt;
            &lt;?php endforeach; ?&gt;
        &lt;/select&gt;

        &lt;label for="accountID"&gt;Account ID:&lt;/label&gt;
        &lt;select id="accountID" name="accountID" required&gt;
            &lt;option value=""&gt;Select Account&lt;/option&gt;
            &lt;?php foreach ($accounts as $account): ?&gt;
                &lt;option value="&lt;?php echo $account['AccountID']; ?&gt;"&gt;&lt;?php echo $account['AccountName']; ?&gt; (ID: &lt;?php echo $account['AccountID']; ?&gt;)&lt;/option&gt;
            &lt;?php endforeach; ?&gt;
        &lt;/select&gt;

        &lt;label for="transactionTypeID"&gt;Transaction Type ID:&lt;/label&gt;
        &lt;select id="transactionTypeID" name="transactionTypeID" required&gt;
            &lt;option value=""&gt;Select Transaction Type&lt;/option&gt;
            &lt;?php foreach ($transactionTypes as $transactionType): ?&gt;
                &lt;option value="&lt;?php echo $transactionType['TransactionTypeID']; ?&gt;"&gt;&lt;?php echo $transactionType['TransactionTypeName']; ?&gt; (ID: &lt;?php echo $transactionType['TransactionTypeID']; ?&gt;)&lt;/option&gt;
            &lt;?php endforeach; ?&gt;
        &lt;/select&gt;

        &lt;button type="submit"&gt;Add&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;/body&gt;
&lt;/html&gt;


  </code>
</pre>

This code lets a user enter details about a transaction (such as date, amount, and type), and upon submission, these details are stored securely in the database. The process involves collecting data, preparing and binding it to a SQL query, and executing the query to save the transaction. The user-friendly form allows easy data entry and ensures that the information is properly structured before being saved.

## OUTPUT FOR INSERTING THE DATA


## OUTPUT FOR FETCHING THE DATA

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

