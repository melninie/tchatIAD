<?php
    session_start();

    // Check that a user is 'logged'
    if (empty($_SESSION) || !isset($_SESSION['login']) || empty($_SESSION['login']) || !isset($_SESSION['id']) || empty($_SESSION['id'])) {
        header('location:../index.php');
    }
?>

<html lang="fr">
<head>
    <title>Tchat I@D</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
</head>
<body>
<div class="container-fluid bg-light">
    <div class="row" style="height: 100%; max-height: 100%;">
        <span class="col-md-3 col-sm-3 col-lg-3 fixed-left bg-dark text-white">

            <div id="div_membres" class="row" style="max-height: 100%; overflow-y: scroll;">
                <span class="col-md-12 col-sm-12 col-lg-12" style="height: 100%;">
                    <h4>Bienvenue <?php echo $_SESSION['login'] ?> !</h4>
                    <hr color="white">
                    <h3 class="text-center">Membres</h3>

                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 1</b> <small>(Dernier message : 22h30)</small>
                    </p>
                    <p>
                        <b>Tst Usr 100</b> <small>(Dernier message : 22h30)</small>
                    </p>
                </span>
            </div>
        </span>
        <span class="col-md-9 col-sm-9 col-lg-9  bg-light">
            <div class="row" style="max-height: 100%; overflow-y: scroll;" id="div_messages">
                <span class="col-md-12 col-sm-12 col-lg-12 p-3 mb-2 bg-light" style="background-color: yellow">
                    <!-- Display messages -->
                    <div class="alert alert-primary">
                        <b>fdsjkfj : </b><hr>A simple primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary">
                        <b>fdsjkfj : </b>A simple secondary alert—check it out!
                    </div>
                    <div class="alert alert-primary">
                        <b>fdsjkfj : </b>A simple primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary">
                        <b>fdsjkfj : </b>A simple secondary alert—check it out!
                    </div>
                    <div class="alert alert-primary">
                        <b>fdsjkfj : </b>A simple primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary">
                        <b>fdsjkfj : </b>A simple secondary alert—check it out!
                    </div>
                    <div class="alert alert-primary">
                        <b>fdsjkfj : </b>A simple primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary">
                        <b>fdsjkfj : </b>A simple secondary alert—check it out!
                    </div>
                    <div class="alert alert-primary">
                        <b>fdsjkfj : </b>A simple primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary">
                        <b>fdsjkfj : </b>A simple secondary alert—check it out!
                    </div>
                    <div class="alert alert-primary">
                        <b>fdsjkfj : </b>A simple primary alert—check it out!
                    </div>
                    <div class="alert alert-secondary">
                        <b>fdsjkfj : </b>A simple secondary alert—check it out!
                    </div>
                </span>

            </div>
            <!-- Form for message -->
            <span class="col-md-12 col-sm-12 col-lg-12 fixed-bottom bg-dark " style="background-color: purple" id="span_message">
                <br>
                <div class="input-group mb-3">
                    <input type="text" id="message" class="form-control" name="message" maxlength="500" placeholder="Votre message ..." aria-label="message" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-success" type="button" id="send_message" onclick="test('tetetetet');" value="Envoyer"/>
                    </div>
                </div>
            </span>
        </span>
    </div>

</div>

<script type="text/javascript">
    $( document ).ready(function() {
        var h1, h2;
        h1 = $('#span_message').height();
        h2 = jQuery(window).height();
        $('#div_membres').height(h2-h1);
        $('#div_messages').height(h2-h1);
        $('#div_messages').animate({
            scrollTop: $('#div_messages').get(0).scrollHeight}, 10);
    });

    function test(text) {
        var url = '../controllers/c_send_message.php';
        var message = $("#message").val();
        $.ajax({
            type: "POST",
            url: url,
            data: { message: message },
            dataType : 'json'
        }).done(function(data) {
            alert( "Data Saved: " + data.return );
        });
    }
</script>

</body>
</html>
