<?php
require 'conn.php';

class Account {
    public $accountNumber;
    public $ownerName;
    public $accountType;
    public $extraInfo;

    public function __construct($accountNumber, $ownerName, $accountType, $extraInfo = null) {
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->accountType = $accountType;
        $this->extraInfo = $extraInfo;
    }

    public function save() {
        global $NEobank;

        try {
            $query = $NEobank->prepare("INSERT INTO accounts (account_number, owner_name, account_type) 
                                        VALUES (:accountNumber, :ownerName, :accountType)");
            $query->execute([
                ':accountNumber' => $this->accountNumber,
                ':ownerName' => $this->ownerName,
                ':accountType' => $this->accountType
            ]);

            switch ($this->accountType) {
                case 'savings':
                    $query = $NEobank->prepare("INSERT INTO savings_accounts (account_number, rate) 
                                                VALUES (:accountNumber, :rate)");
                    $query->execute([':accountNumber' => $this->accountNumber, ':rate' => $this->extraInfo]);
                    break;

                case 'current':
                    $query = $NEobank->prepare("INSERT INTO current_accounts (account_number, overdraft_limit) 
                                                VALUES (:accountNumber, :overdraftLimit)");
                    $query->execute([':accountNumber' => $this->accountNumber, ':overdraftLimit' => $this->extraInfo]);
                    break;

                case 'business':
                    $query = $NEobank->prepare("INSERT INTO business_accounts (account_number, task) 
                                                VALUES (:accountNumber, :task)");
                    $query->execute([':accountNumber' => $this->accountNumber, ':task' => $this->extraInfo]);
                    break;
            }

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
