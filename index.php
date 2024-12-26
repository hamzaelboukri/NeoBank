<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>NeoBank</title>
</head>
<body>
<header class="header">
        <h1>NeoBank</h1>
        <p>des Comptes Bancaires</p>
    </header>

    <form action="">

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
                        <label for="interestRate">(%)</label>
                        <input type="number" id="interestRate" name="interestRate" step="0.01">
                    </div>
                </div>

                <div id="current" class="account-type">
                    <div class="form-group">
                        <label for="overdraftLimit"></label>
                        <input type="number" id="overdraftLimit" name="overdraftLimit" step="0.01">
                    </div>
                </div>

                <div id="business" class="account-type">
                    <div class="form-group">
                        <label for="task transaction"></label>
                        <input type="number" id="task-transaction" name="task-transaction" step="0.01">
                    </div>
                </div>

                <button type="submit" class="btn-primary">save</button>
    </form>





    <script src="script.js"></script>
    
</body>
</html>
