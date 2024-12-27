<?php
try {
    $NEobank = new PDO('mysql:host=localhost;dbname=neobank', 'root', '');
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    echo "Failed to connect to the database: " . $e->getMessage();
}


if (isset($_POST['accountNumber']) && isset($_POST['ownerName']) && isset($_POST['accountType'])) {
    $accountNumber = $_POST['accountNumber'];
    $ownerName = $_POST['ownerName'];
    $accountType = $_POST['accountType'];
    $interestRate = $_POST['interestRate'];
    $overdraftLimit = $_POST['overdraftLimit'];
    $taskTransaction = $_POST['taskTransaction'];

}
?>


<?php

class acount {
    public $accountNumber;
    public $ownerName;
    public $accountType;
    public $interestRate;
    public $overdraftLimit;
    public $taskTransaction;

    public function __construct($accountNumber, $ownerName, $accountType, $interestRate, $overdraftLimit, $taskTransaction) {
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->accountType = $accountType;
        $this->interestRate = $interestRate;
        $this->overdraftLimit = $overdraftLimit;
        $this->taskTransaction = $taskTransaction;
    }

    public function save() {
        global $NEobank;
        $query = $NEobank->prepare("INSERT INTO account (accountNumber,
         ownerName,
          accountType,
           Rate,
            overdraftLimit, 
            taskTransaction) VALUES (:accountNumber, 
            :ownerName,
             :accountType, 
             :Rate, 
             :overdraftLimit,
              :task)");
        $query->bindParam(':accountNumber', $this->accountNumber);
        $query->bindParam(':ownerName', $this->ownerName);
        $query->bindParam(':accountType', $this->accountType);
        $query->bindParam(':interestRate', $this->interestRate);
        $query->bindParam(':overdraftLimit', $this->overdraftLimit);
        $query->bindParam(':task', $this->taskTransaction);
        $query->execute();
    }

    public function getAccount() {
        global $NEobank;
        $query = $NEobank->prepare("SELECT * FROM account");
        $query->execute();
        return $query->fetchAll();
    }

}







?>




