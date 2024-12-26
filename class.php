<?php
$NeoBank = new PDO("mysql:host=localhost;dbname=neobank", "root", "");
$NeoBank->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountNumber = $_POST['accountNumber'];
    $ownerName = $_POST['ownerName'];
    $accountType = $_POST['accountType'];
    
    try {
        switch($accountType) {
            case 'savings':
                $account = new SavingsAccount($NeoBank, $accountNumber, $ownerName, 0.0, $_POST['interestRate']);
                break;
            case 'current':
                $account = new CurrentAccount($NeoBank, $accountNumber, $ownerName, 0.0, $_POST['overdraftLimit']);
                break;
            case 'business':
                $account = new BusinessAccount($NeoBank, $accountNumber, $ownerName, 0.0, $_POST['task-transaction']);
                break;
        }
        
        $account->createAccount();
        header("Location: index.php");
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
?>


