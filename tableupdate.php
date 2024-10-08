<?php

require 'dbconfig.php'; 

// Fetch all transactions from the database
$transactions = $conn->query("SELECT TransactionID, Date, Amount, CategoryID, AccountID, TransactionTypeID, Description FROM Transactions")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 6px 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<h2>All Transactions</h2>

<table>
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Category ID</th>
            <th>Account ID</th>
            <th>Transaction Type ID</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($transactions) > 0): ?>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['TransactionID']; ?></td>
                    <td><?php echo $transaction['Date']; ?></td>
                    <td><?php echo $transaction['Amount']; ?></td>
                    <td><?php echo $transaction['CategoryID']; ?></td>
                    <td><?php echo $transaction['AccountID']; ?></td>
                    <td><?php echo $transaction['TransactionTypeID']; ?></td>
                    <td><?php echo $transaction['Description']; ?></td>
                    <td>
                        <!-- Update form -->
                        <form action="update.php" method="POST" style="display:inline;">
                            <input type="hidden" name="transactionID" value="<?php echo $transaction['TransactionID']; ?>">
                            <button type="submit" name="update_transaction">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No transactions found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
