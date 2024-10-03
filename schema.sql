 CREATE TABLE Categories (
 CategoryID INTEGER PRIMARY KEY,
 CategoryName TEXT NOT NULL
 );

 CREATE TABLE Accounts (
 AccountID INTEGER PRIMARY KEY,
 AccountName TEXT NOT NULL
 );

 CREATE TABLE TransactionTypes (
 TransactionTypeID INTEGER PRIMARY KEY,
 TransactionTypeName TEXT NOT NULL
 );

 CREATE TABLE Transactions(
 TransactionID INTEGER PRIMARY KEY,
 Date DATE NOT NULL,
 Amount DECIMAL NOT NULL,
 CategoryID INTEGER,
 AccountID INTEGER,
 TransactionTypeID INTEGER,
 Description TEXT,
 DateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID),
 FOREIGN KEY (AccountID) REFERENCES Accounts(AccountID),
 FOREIGN KEY (TransactionTypeID) REFERENCES
 TransactionTypes(TransactionTypeID)
 );

 CREATE TABLE Balances (
 BalanceID INTEGER PRIMARY KEY,
 AccountID INTEGER,
 StartDate DATE NOT NULL,
 BeginningBalance DECIMAL(10, 2) NOT NULL,
 FOREIGN KEY (AccountID) REFERENCES Accounts(AccountID)
);
