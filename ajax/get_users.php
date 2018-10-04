<script type="text/javascript">
    function displayUsers(users){
        $(users).each(function(i, item) {
            // if connected user sent this message
            var date = '';
            var classe = 'list-group-item  align-items-center';
            if(item.login == "<?php echo $_SESSION['login'] ?>") {
                classe = 'list-group-item list-group-item-action list-group-item-primary';
            }
            var today = getDateMessage({'date': new Date()});
            var last_message = getDateMessage({'date': item.date});

            if(item.date != null && item.date != undefined && item.date != '') {
                if(last_message == today) {
                    date = 'Dernier message : ' + getHeureMessage({'date': item.date});
                }
                else {
                    date = 'Dernier message : ' + last_message + ' à ' + getHeureMessage({'date': item.date});
                }
            }

            $( "#users" ).append('' +
                '<li class=\"'+ classe+'\" style=\"color:black\">'+
                item.login+
                '<br><span class=\"badge badge-primary badge-pill\">'+date+'</span>'+
                '</li>'
            );
        });
    }

    function getUsers() {
        var url = '../controllers/c_get_users.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType : 'json'
        }).done(function(data) {
            displayUsers(data.users);
        });
    }

</script>
