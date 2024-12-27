<?php
require 'conn.php';
require 'class.php';

$account = new Account(null, null, null);
$accounts = $account->getAccounts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Comptes - NeoBank</title>
    <style>
       
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des Comptes</h1>
    </div>



    <div class="sidebar">
      <h2>Dashboard</h2>
      <ul>
      <li>
    <a href="index.php">
        <img src="./img/home.png" alt="club" width="30px" height="30px"> Home
    </a>
</li>
<li>
    <a href="admin_page.php">
        <img src="./img/icone.png" alt="club" width="30px" height="30px"> Statistics
    </a>
</li>
<li>
    <a href="clup.php">
        <img src="./img/clup.png" alt="club" width="30px" height="30px"> Add Club
    </a>
</li>
<li>
    <a href="ntc.php">
        <img src="./img/clup.png" alt="club" width="30px" height="30px"> Nationalities
    </a>
</li>


        <li><a>Settings</a></li>
      </ul>
    </div>
    
    <div class="container">
        <table class="accounts-table">
            <thead>
                <tr>
                    <th>Numéro de Compte</th>
                    <th>Propriétaire</th>
                    <th>Type de Compte</th>
                    <th>Taux d'Intérêt</th>
                    <th>Limite de Découvert</th>
                    <th>Frais de Transaction</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($accounts): foreach ($accounts as $acc): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($acc['account_number']); ?></td>
                        <td><?php echo htmlspecialchars($acc['owner_name']); ?></td>
                        <td><?php echo htmlspecialchars($acc['account_type']); ?></td>
                        <td><?php echo $acc['interest_rate'] ? htmlspecialchars($acc['interest_rate']) . '%' : '-'; ?></td>
                        <td><?php echo $acc['overdraft_limit'] ? htmlspecialchars($acc['overdraft_limit']) : '-'; ?></td>
                        <td><?php echo $acc['task_transaction'] ? htmlspecialchars($acc['task_transaction']) : '-'; ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
