<?php

require 'conn.php';

class Account {
    public $accountNumber;
    public $ownerName;
    public $accountType;
    public $interestRate;
    public $overdraftLimit;
    public $taskTransaction;

    public function __construct($accountNumber, $ownerName, $accountType, $interestRate = null, $overdraftLimit = null, $taskTransaction = null) {
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->accountType = $accountType;
        $this->interestRate = $interestRate;
        $this->overdraftLimit = $overdraftLimit;
        $this->taskTransaction = $taskTransaction;
    }

    public function save() {

        global $NEobank;

        try {
            $NEobank->beginTransaction();

            $query = $NEobank->prepare("INSERT INTO accounts (account_number, owner_name, account_type) 
                                        VALUES (:accountNumber, :ownerName, :accountType)");
            
            $query->bindParam(':accountNumber', $this->accountNumber);
            $query->bindParam(':ownerName', $this->ownerName);
            $query->bindParam(':accountType', $this->accountType);
            $query->execute();
            
            $accountId = $NEobank->lastInsertId();
            
            switch ($this->accountType) {

                case 'savings':
                    $query = $NEobank->prepare("INSERT INTO savings_accounts (account_id, rate) 
                                                VALUES (:accountId, :rate)");
                    $query->bindParam(':accountId', $accountId);
                    $query->bindParam(':rate', $this->interestRate);
                    break;
                    
                case 'current':
                    $query = $NEobank->prepare("INSERT INTO current_accounts (account_id, overdraft_limit) 
                                                VALUES (:accountId, :overdraftLimit)");
                    $query->bindParam(':accountId', $accountId);
                    $query->bindParam(':overdraftLimit', $this->overdraftLimit);
                    break;
                    
                case 'business':
                    $query = $NEobank->prepare("INSERT INTO business_accounts (account_id, task) 
                                                VALUES (:accountId, :task)");
                    $query->bindParam(':accountId', $accountId);
                    $query->bindParam(':task', $this->taskTransaction);
                    break;
            }
            
            $query->execute();
            $NEobank->commit();
            
            return true;

        } catch (Exception $e) {
            $NEobank->rollBack();
            error_log("Error saving account: " . $e->getMessage());
            return false;
        }
    }

    public function getAccounts() {
        global $NEobank;
        try {
            $query = $NEobank->prepare("
                SELECT a.*, 
                    s.rate AS interest_rate, 
                    c.overdraft_limit, 
                    b.task AS task_transaction
                FROM accounts a
                LEFT JOIN savings_accounts s ON a.account_id = s.account_id
                LEFT JOIN current_accounts c ON a.account_id = c.account_id
                LEFT JOIN business_accounts b ON a.account_id = b.account_id
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting accounts: " . $e->getMessage());
            return false;
        }
    }
}
?>
