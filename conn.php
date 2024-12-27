<?php
try {
    $NEobank = new PDO('mysql:host=localhost;dbname=neobank', 'root', '', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Connection failed. Please try again later.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accountNumber']) && isset($_POST['ownerName']) && isset($_POST['accountType'])) {
        $account = new Account(
            $_POST['accountNumber'],
            $_POST['ownerName'],
            $_POST['accountType'],
            $_POST['interestRate'] ?? null,
            $_POST['overdraftLimit'] ?? null,
            $_POST['taskTransaction'] ?? null
        );
        
        if ($account->save()) {
            header('Location: aficher.php?success=1');
            exit;
        }
        //  else {
        //     header('Location: index.php?error=1');
        //     exit;
        // }
    }
}

?>
