 INSERT INTO Categories (CategoryID, CategoryName) VALUES
 (1, 'Operating'),
 (2, 'Investing'),
 (3, 'Financing');
 INSERT INTO Accounts (AccountID, AccountName) VALUES
 (1, 'Cash'),
 (2, 'Bank Account'),
 (3, 'Accounts Receivable'),
 (4, 'Accounts Payable'),
 (5, 'Investment Fund');
 INSERT INTO TransactionTypes (TransactionTypeID, TransactionTypeName) VALUES
 (1, 'Sales'),
 (2, 'Service Revenue'),
 (3, 'Expense'),
 (4, 'Capital Expenditure'),
 (5, 'Loan Repayment');-- Insert transactions
 INSERT INTO Transactions (Date, Amount, CategoryID, AccountID, TransactionTypeID,
 Description) VALUES
 ('2024-09-01', 1000.00, 1, 1, 1, 'Sales revenue from product X'),
 ('2024-09-02', 500.00, 1, 3, 2, 'Service revenue from consulting'),
 ('2024-09-03', 1500.00, 2, 5, 4, 'Investment return on fund A'),
 ('2024-09-04', 2500.00, 1, 1, 1, 'Additional sales revenue from new product line'),
 ('2024-09-05', 1200.00, 1, 1, 2, 'Refund received from client'),
 ('2024-09-01', 200.00, 1, 4, 3, 'Office supplies purchase'),
 ('2024-09-02', 300.00, 2, 1, 5, 'Loan repayment'),
 ('2024-09-03', 800.00, 2, 1, 4, 'Investment in new asset'),
 ('2024-09-04', 450.00, 1, 4, 3, 'Maintenance expenses for office equipment'),
 ('2024-09-05', 600.00, 1, 3, 3, 'Payment for outsourced services');
 INSERT INTO Balances (AccountID, StartDate, BeginningBalance) VALUES
 (1, '2024-01-01', 5000);
