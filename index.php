<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tchat I@D</title>
</head>
<body>
    <div class="container">
        <h1>Authentification</h1>
        <form action="controllers/c_authentication.php" method="post">
            <label for="login">Pseudo : </label>
            <input type="text" id="login" name="login" required>
            <input type="submit" value="GO !">
        </form>
    </div>
</body>
</html>