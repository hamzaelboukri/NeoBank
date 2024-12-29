<?php
require 'conn.php';

class Account {
    public function getAccounts() {
        global $NEobank;

        try {
            $query = $NEobank->prepare("
                SELECT a.*, 
                       s.rate AS interest_rate, 
                       c.overtdartlimit AS overdraft_limit,  -- Fixed column name
                       b.task AS task_transaction
                FROM accounts a
                LEFT JOIN savings_accounts s ON s.account_id = a.account_id  -- Fixed join condition
                LEFT JOIN current_accounts c ON c.account_id = a.account_id  -- Fixed join condition
                LEFT JOIN business_accounts b ON b.account_id = a.account_id -- Fixed join condition
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error retrieving accounts: " . $e->getMessage());
            return [];
        }
    }
}

$account = new Account();
$accounts = $account->getAccounts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../cssfils/style.css">
    <title>Liste des Comptes - NeoBank</title>
</head>
<body>
    <div class="header">
        <h1>Liste des Comptes</h1>
    </div>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="admin_page.php">Compte</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>
    
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">Account created successfully!</div>
        <?php endif; ?>
        
        <table class="accounts-table">
            <thead>
                <tr>
                    <th>Numéro de Compte</th>
                    <th>Propriétaire</th>
                    <th>Type de Compte</th>
                    <th>Solde</th>
                    <th>Taux d'Intérêt</th>
                    <th>Limite de Découvert</th>
                    <th>Frais de Transaction</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($accounts && count($accounts) > 0): ?>
                    <?php foreach ($accounts as $acc): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($acc['account_number']); ?></td>
                            <td><?php echo htmlspecialchars($acc['owner_name']); ?></td>
                            <td><?php echo htmlspecialchars($acc['account_type']); ?></td>
                            <td><?php echo number_format($acc['balance'], 2) . ' €'; ?></td>
                            <td><?php echo isset($acc['interest_rate']) ? htmlspecialchars($acc['interest_rate']) . '%' : '-'; ?></td>
                            <td><?php echo isset($acc['overdraft_limit']) ? htmlspecialchars($acc['overdraft_limit']) . ' €' : '-'; ?></td>
                            <td><?php echo isset($acc['task_transaction']) ? htmlspecialchars($acc['task_transaction']) . ' €' : '-'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7">Aucun compte trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
