<?php
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
    $stmt = $conn->prepare("INSERT INTO Transactions (Date, Amount, CategoryID, AccountID, TransactionTypeID, Description) 
                             VALUES (:date, :amount, :categoryID, :accountID, :transactionTypeID, :description)");
    
    // Bind parameters
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':categoryID', $categoryID);
    $stmt->bindParam(':accountID', $accountID);
    $stmt->bindParam(':transactionTypeID', $transactionTypeID);
    $stmt->bindParam(':description', $description);
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Transaction inserted successfully!";
    } else {
        echo "Error inserting transaction: " . $stmt->errorInfo()[2];
    }
}

// Fetch categories, accounts, and transaction types from the database
$categories = $conn->query("SELECT CategoryID, CategoryName FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$accounts = $conn->query("SELECT AccountID, AccountName FROM accounts")->fetchAll(PDO::FETCH_ASSOC);
$transactionTypes = $conn->query("SELECT TransactionTypeID, TransactionTypeName FROM transactiontypes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Transaction</title>
    <style>
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
    </style>
</head>
<body>

<div class="container">
    <h2>Insert Transaction</h2>
    <form action="insert.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required placeholder="Enter transaction description"></textarea>

        <label for="categoryID">Category ID:</label>
        <select id="categoryID" name="categoryID" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['CategoryID']; ?>"><?php echo $category['CategoryName']; ?> (ID: <?php echo $category['CategoryID']; ?>)</option>
            <?php endforeach; ?>
        </select>

        <label for="accountID">Account ID:</label>
        <select id="accountID" name="accountID" required>
            <option value="">Select Account</option>
            <?php foreach ($accounts as $account): ?>
                <option value="<?php echo $account['AccountID']; ?>"><?php echo $account['AccountName']; ?> (ID: <?php echo $account['AccountID']; ?>)</option>
            <?php endforeach; ?>
        </select>

        <label for="transactionTypeID">Transaction Type ID:</label>
        <select id="transactionTypeID" name="transactionTypeID" required>
            <option value="">Select Transaction Type</option>
            <?php foreach ($transactionTypes as $transactionType): ?>
                <option value="<?php echo $transactionType['TransactionTypeID']; ?>"><?php echo $transactionType['TransactionTypeName']; ?> (ID: <?php echo $transactionType['TransactionTypeID']; ?>)</option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add</button>
    </form>
</div>

</body>
</html>
