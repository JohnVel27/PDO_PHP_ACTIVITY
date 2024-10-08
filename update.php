<?php

require 'dbconfig.php'; 

// Variable to hold the success message
$successMessage = "";

// Fetch the transaction data if the form hasn't been submitted yet (e.g., when the user clicks the "Edit" button)
if (isset($_GET['transactionID'])) {
    $transactionID = $_GET['transactionID'];

    // Prepare and execute a query to fetch the current data for the specific transaction
    $stmt = $conn->prepare("SELECT * FROM Transactions WHERE TransactionID = :transactionID");
    $stmt->bindParam(':transactionID', $transactionID);
    $stmt->execute();

    // Fetch the transaction data
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$transaction) {
        echo "Transaction not found!";
        exit;
    }
}

// Check if the update form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_transaction'])) {
    $transactionID = $_POST['transactionID'];  
    $date = $_POST['date'];  
    $amount = $_POST['amount'];  
    $categoryID = $_POST['categoryID'];  
    $accountID = $_POST['accountID'];  
    $transactionTypeID = $_POST['transactionTypeID'];  
    $description = $_POST['description'];  

    // Prepare and execute the SQL UPDATE statement
    $stmt = $conn->prepare("UPDATE Transactions 
                            SET Date = :date, Amount = :amount, CategoryID = :categoryID, 
                                AccountID = :accountID, TransactionTypeID = :transactionTypeID, 
                                Description = :description
                            WHERE TransactionID = :transactionID");
    
    // Bind parameters
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':categoryID', $categoryID);
    $stmt->bindParam(':accountID', $accountID);
    $stmt->bindParam(':transactionTypeID', $transactionTypeID);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':transactionID', $transactionID);

    // Execute the update and check for success
    if ($stmt->execute()) {
        $successMessage = "Transaction updated successfully!"; // Set success message
        header("Location: update.php?transactionID=" . $transactionID); // Redirect back after update
        exit;
    } else {
        echo "Error updating transaction: " . $stmt->errorInfo()[2];
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
    <title>Update Transaction</title>
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
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
        .return-button {
            display: inline-block; /* Make it an inline block to style it like a button */
            text-align: center; /* Center text */
            background-color: #e74c3c; /* Different color for return button */
            color: white; /* Text color */
            padding: 10px; /* Padding */
            border-radius: 4px; /* Rounded corners */
            text-decoration: none; /* Remove underline */
            margin-top: 10px; /* Space above the button */
            width: 100%; /* Full width */
        }
        .return-button:hover {
            background-color: #c0392b; /* Darker color on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Transaction</h2>
    
    <!-- Display success message if set -->
    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <form action="update.php" method="POST">
        <input type="hidden" name="transactionID" value="<?php echo $transaction['TransactionID']; ?>">

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $transaction['Date']; ?>" required>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" value="<?php echo $transaction['Amount']; ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo $transaction['Description']; ?></textarea>

        <label for="categoryID">Category ID:</label>
        <select id="categoryID" name="categoryID" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['CategoryID']; ?>" <?php if ($transaction['CategoryID'] == $category['CategoryID']) echo 'selected'; ?>>
                    <?php echo $category['CategoryName']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="accountID">Account ID:</label>
        <select id="accountID" name="accountID" required>
            <option value="">Select Account</option>
            <?php foreach ($accounts as $account): ?>
                <option value="<?php echo $account['AccountID']; ?>" <?php if ($transaction['AccountID'] == $account['AccountID']) echo 'selected'; ?>>
                    <?php echo $account['AccountName']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="transactionTypeID">Transaction Type ID:</label>
        <select id="transactionTypeID" name="transactionTypeID" required>
            <option value="">Select Transaction Type</option>
            <?php foreach ($transactionTypes as $transactionType): ?>
                <option value="<?php echo $transactionType['TransactionTypeID']; ?>" <?php if ($transaction['TransactionTypeID'] == $transactionType['TransactionTypeID']) echo 'selected'; ?>>
                    <?php echo $transactionType['TransactionTypeName']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="update_transaction">Update Transaction</button>
    </form>

    <!-- Return to transaction list link -->
    <a href="tableupdate.php" class="return-button">Return to Transaction List</a>
    
</div>

</body>
</html>
