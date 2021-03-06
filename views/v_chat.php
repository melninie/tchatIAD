<?php
    require_once '/entities/e_user.php';
?>

<html lang="fr">
    <head>
        <title>Tchat I@D</title>
        <style>
            .hr {
                display: -webkit-box;
                display: -moz-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;

                -webkit-box-align: center;
                -moz-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;

                margin: 1em 0;

                text-align: center;
            }
            .hr::before, .hr::after {
                content: '';

                -webkit-box-flex: 1;
                -moz-box-flex: 1;
                -webkit-flex: 1;
                -ms-flex: 1;
                flex: 1;

                margin: 0 .25em;

                border-bottom: 1px solid #000;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
    </head>
    <body>
        <div class="container-fluid bg-light">
            <div class="row" style="height: 100%; max-height: 100%;">
                <span class="col-md-3 col-sm-3 col-lg-3 fixed-left bg-dark text-white">

                    <div id="div_membres" class="row" style="max-height: 100%; overflow-y: scroll;">
                        <span class="col-md-12 col-sm-12 col-lg-12" style="height: 100%;">
                            <h4>Bienvenue <?php echo unserialize($_SESSION['user'])->getLogin() ?> !</h4>
                            <a class="btn btn-danger btn-sm" href="index.php?action=logout" role="button">Déconnexion</a>

                            <hr color="white">
                            <h3 class="text-center">Membres</h3>

                            <ul id="users" class="list-group">
                                <!-- Dislay users -->
                                <?php
                                    if ($res_users['error']) {
                                        echo 'Une erreur est survenue durant la récupération des utilisateurs.';
                                    }
                                    elseif (count($res_users['users']) == 0) {
                                        echo 'Il n\'y a aucun message à afficher';
                                    }
                                    else {
                                        foreach ($res_users['users'] as $u) {
                                            $user = $u['user'];

                                            // if connected user sent this message
                                            $date_display = '';
                                            $classe = 'list-group-item  align-items-center';
                                            if($user->getLogin() == unserialize($_SESSION['user'])->getLogin()) {
                                                $classe = 'list-group-item list-group-item-action list-group-item-primary';
                                            }

                                            // if last message date is today, just display hour
                                            $today = new DateTime();
                                            $today = $today->format('d/m/Y');

                                            if($u['date_last_message'] != null && $u['date_last_message'] != '' && $u['date_last_message'] != NULL) {
                                                $last_message = new DateTime($u['date_last_message']);
                                                $date_last_message = $last_message->format('d/m/Y');
                                                $hour_last_message = $last_message->format('H:i');
                                                if($date_last_message == $today) {
                                                    $date_display = 'Dernier message : '.$hour_last_message;
                                                }
                                                else {
                                                    $date_display = 'Dernier message : '.$date_last_message.' à '.$hour_last_message;
                                                }
                                            }

                                            echo '<li class="'.$classe.'" style="color:black">'.
                                                $user->getLogin().
                                                '<br><span class="badge badge-primary badge-pill">'.$date_display.'</span>'.
                                                '</li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </span>
                    </div>
                </span>
                <span class="col-md-9 col-sm-9 col-lg-9  bg-light">
                    <div class="row" style="max-height: 100%; overflow-y: scroll;" id="div_messages">
                        <span id="list_messages" class="col-md-12 col-sm-12 col-lg-12 p-3 mb-2 bg-light" style="background-color: yellow">
                            <!-- Display messages -->
                            <?php
                                if ($res_messages['error']) {
                                    echo 'Une erreur est survenue durant la récupération des messages.';
                                }
                                elseif (count($res_messages['messages']) == 0) {
                                    echo 'Il n\'y a aucun message à afficher';
                                }
                                else {
                                    $previous_date = '';
                                    foreach ($res_messages['messages'] as $message) {
                                        $date_message = $message->getDisplayDate();

                                        // add separation if date of this message is differente from the previous one
                                        if($previous_date != $date_message) {
                                            echo '<div class="hr">'.$message->getDisplayDate().'</div>';
                                            $previous_date = $date_message.'';
                                        }

                                        // if connected user sent this message
                                        $classe = "alert alert-secondary";
                                        if ($message->getSender()->getLogin() == unserialize($_SESSION['user'])->getLogin()) {
                                            $classe = "alert alert-primary";
                                        }

                                        // display message
                                        echo '<div class="'.$classe.'"><b>'.$message->getSender()->getLogin().'</b> '.$message->getDisplayHour().
                                            ' :<br>'.$message->getContent().'</div>';
                                    }
                                }
                            ?>
                        </span>

                    </div>
                    <!-- Form for message -->
                    <span class="col-md-12 col-sm-12 col-lg-12 fixed-bottom bg-dark " style="background-color: purple" id="span_message">
                        <br>
                        <form action="index.php?action=send_message" method="post">
                            <div class="input-group mb-3">
                                <input type="text" id="message" class="form-control" name="message" maxlength="500" placeholder="Votre message ..." aria-label="message" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <input class="btn btn-success" type="submit" id="send_message" value="Envoyer"/>
                                </div>
                            </div>
                        </form>
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
                $('#div_messages').animate(
                    {scrollTop: $('#div_messages').get(0).scrollHeight}, 1
                );
            });
        </script>
    </body>
</html>
