<html lang="fr">
<head>
    <title>Tchat I@D</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Authentification</h1>
        <?php 
            if (isset($_GET['message']) && $_GET['message'] == 'alreadyExist') {
                ?>
                <p style="color: red;;">
                    Ce login est déjà utilisé, merci d'en choisir un autre.
                </p>
                <?php
            }
        ?>
        <form action="controllers/c_authentication.php" method="post">
            <label for="login">Pseudo : </label>
            <input type="text" id="login" name="login" required>
            <input type="submit" value="GO !">
        </form>
    </div>
</body>
</html>