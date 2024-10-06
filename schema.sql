 -- Table for storing category information
CREATE TABLE Categories (
 CategoryID INT PRIMARY KEY AUTO_INCREMENT, -- Primary key with auto-increment for unique Category IDs
 CategoryName TEXT NOT NULL -- Name of the category (cannot be null)
);

-- Table for storing account information
CREATE TABLE Accounts (
 AccountID INT PRIMARY KEY AUTO_INCREMENT, -- Primary key with auto-increment for unique Account IDs
 AccountName TEXT NOT NULL -- Name of the account (cannot be null)
);

-- Table for storing transaction types (e.g., income, expense, etc.)
CREATE TABLE TransactionTypes (
 TransactionTypeID INT PRIMARY KEY AUTO_INCREMENT, -- Primary key with auto-increment for unique Transaction Type IDs
 TransactionTypeName TEXT NOT NULL -- Name of the transaction type (cannot be null)
);

-- Table for storing transaction records
CREATE TABLE Transactions(
 TransactionID INT PRIMARY KEY AUTO_INCREMENT, -- Primary key with auto-increment for unique Transaction IDs
 Date DATE NOT NULL, -- Date of the transaction (cannot be null)
 Amount DECIMAL NOT NULL, -- Amount involved in the transaction
 CategoryID INT, -- Foreign key to the Categories table
 AccountID INT, -- Foreign key to the Accounts table
 TransactionTypeID INT, -- Foreign key to the TransactionTypes table
 Description TEXT, -- Optional description for the transaction
 DateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the transaction record was added
 FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID), -- Foreign key constraint for CategoryID
 FOREIGN KEY (AccountID) REFERENCES Accounts(AccountID), -- Foreign key constraint for AccountID
 FOREIGN KEY (TransactionTypeID) REFERENCES TransactionTypes(TransactionTypeID) -- Foreign key constraint for TransactionTypeID
);

-- Table for storing balance information
CREATE TABLE Balances (
 BalanceID INT PRIMARY KEY AUTO_INCREMENT, -- Primary key with auto-increment for unique Balance IDs
 AccountID INT, -- Foreign key to the Accounts table
 StartDate DATE NOT NULL, -- Start date of the balance period
 BeginningBalance DECIMAL(10, 2) NOT NULL, -- Initial balance at the start of the period
 FOREIGN KEY (AccountID) REFERENCES Accounts(AccountID) -- Foreign key constraint for AccountID
);

