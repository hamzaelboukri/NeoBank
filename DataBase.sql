CREATE TABLE accounts (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    account_number VARCHAR(20) UNIQUE NOT NULL,
    account_type ENUM('savings', 'current', 'business') NOT NULL,
    owner_name VARCHAR(100) NOT NULL,
    balance DECIMAL(15,2) NOT NULL DEFAULT 0.00,
   
);

CREATE TABLE savings_accounts (
    account_id INT PRIMARY KEY,
      rate DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(account_id) ON DELETE CASCADE
);

CREATE TABLE current_accounts (
    overtdartlimit DECIMAL(5,2) NOT NULL,
    account_id INT PRIMARY KEY,
    FOREIGN KEY (account_id) REFERENCES accounts(account_id) ON DELETE CASCADE
);

CREATE TABLE business_accounts (
    account_id INT PRIMARY KEY,
   task DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(account_id) ON DELETE CASCADE
);



