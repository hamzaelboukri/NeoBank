<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../cssfils/style.css">
    <title>NeoBank</title>
</head>
<body>
<header class="header">
        <h1>NeoBank</h1>
        <p>des Comptes Bancaires</p>
    </header>

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
    <form action="class.php" method="post">

    <div class="form"> 
    <label for="accountNumber">Numéro de compte</label>
    <input type="text" id="accountNumber" name="accountNumber" required>
     </div>

     <div class="form">
        <label for="ownerName">Nom du user</label>
        <input type="text" id="ownerName" name="ownerName" required>
      </div>


      <div class="form">
                    <label for="accountType">Type de compte</label>
                    <select id="accountType" name="accountType" required>
                        <option value=""> type</option>
                        <option value="savings">Compte saving </option>
                        <option value="current">Compte current </option>
                        <option value="business">Compte business </option>
                    </select>
                </div>

                <div id="saving" class="account-type">
                    <div class="form-group">
                        <label for="interestRate"> interestRate(%)</label>
                        <input type="number" id="interestRate" name="interestRate" step="0.1">
                    </div>
                </div>

                <div id="current" class="account-type">
                    <div class="form-group">
                        <label for="overdraftLimit"> OverdraftLimit</label>
                        <input type="number" id="overdraftLimit" name="overdraftLimit" step="0.1">
                    </div>
                </div>

                <div id="business" class="account-type">
                    <div class="form-group">
                        <label for="task transaction">Task transaction</label>
                        <input type="number" id="task-transaction" name="taskTransaction" step="0.10">
                    </div>
                </div>

                <button type="submit" class="btn-primary">save</button>
    </form>





    <script src="script.js"></script>
    
</body>
</html>
