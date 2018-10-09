<html lang="fr">
<head>
    <title>Tchat I@D</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
</head>
<body>
<div class="container">
    <div class="row  align-items-center" style="height:100%;">
        <div class="col-12">
            <div class="row justify-content-md-center justify-content-sm-center justify-content-lg-center">
                <div class="row">
                    <h1>Test I@D <small>Version 2</small></h1>
                </div>
            </div>
            <?php
                if (isset($message) && $message == 'alreadyExist') {
                    ?>
                    <div class="row justify-content-md-center justify-content-sm-center justify-content-lg-center">
                        <p style="color: red;">
                            Ce login est déjà utilisé, merci d'en choisir un autre.
                        </p>
                    </div>
                    <?php
                }
            ?>
            <div class="row justify-content-md-center justify-content-sm-center justify-content-lg-center">
                <div class="row">

                    <form action="index.php" method="post">
                        <label for="login">Pseudo : </label>
                        <input type="text" id="login" name="login" required>
                        <input type="submit" value="GO !">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>