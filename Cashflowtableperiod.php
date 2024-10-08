<?php
require 'dbconfig.php'; // Include your database configuration file

// Fetching data from the database
$query = "SELECT 
            b.AccountID, 
            a.AccountName, 
            b.BeginningBalance AS BeginningPeriod,
            SUM(CASE 
                WHEN ty.TransactionTypeID IN (1, 2) THEN t.Amount 
                WHEN ty.TransactionTypeID IN (3, 4, 5) THEN -t.Amount 
                ELSE 0 
            END) AS CashInflowOverall,
            (b.BeginningBalance + SUM(CASE 
                WHEN ty.TransactionTypeID IN (1, 2) THEN t.Amount 
                WHEN ty.TransactionTypeID IN (3, 4, 5) THEN -t.Amount 
                ELSE 0 
            END)) AS EndingPeriod
          FROM Balances b 
          INNER JOIN Accounts a ON b.AccountID = a.AccountID 
          LEFT JOIN Transactions t ON b.AccountID = t.AccountID 
          LEFT JOIN TransactionTypes ty ON t.TransactionTypeID = ty.TransactionTypeID 
          WHERE b.AccountID = 1 
          GROUP BY b.AccountID, a.AccountName, b.BeginningBalance";

$results = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Table</title>
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
    </style>
</head>
<body>

<h2>Cash Flow Overview</h2>

<table>
    <thead>
        <tr>
            <th>AccountID</th>
            <th>AccountName</th>
            <th>BeginningPeriod</th>
            <th>CashInflowOverall</th>
            <th>EndingPeriod</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['AccountID']; ?></td>
                    <td><?php echo $row['AccountName']; ?></td>
                    <td><?php echo $row['BeginningPeriod']; ?></td>
                    <td><?php echo $row['CashInflowOverall']; ?></td>
                    <td><?php echo $row['EndingPeriod']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No data found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
