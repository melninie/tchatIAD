<script type="text/javascript">
    function getMessages() {
        var url = '../controllers/c_get_messages.php';
        $.ajax({
            type: "POST",
            url: url,
            dataType : 'json'
        }).done(function(data) {
            displayMessages(data.messages, function(){
                var h1, h2;
                h1 = $('#span_message').height();
                h2 = jQuery(window).height();
                $('#div_membres').height(h2-h1);
                $('#div_messages').height(h2-h1);
                $('#div_messages').animate(
                    {scrollTop: $('#div_messages').get(0).scrollHeight}, 1
                );
            });
        });
    }

    function displayMessages(messages, callback){
        var previous_date = '';

        $(messages).each(function(i, item) {
            var date_message = getDateMessage(item);
            if(previous_date != date_message) {
                $( "#list_messages" ).append('<div class="hr">'+date_message+'</div>');
                previous_date = date_message + '';
            }

            // if connected user sent this message
            var classe = "alert alert-secondary";
            if(item.login == "<?php echo $_SESSION['login'] ?>") {
                classe = "alert alert-primary";

            }
            $( "#list_messages" ).append('' +
                '<div class="'+classe+'">' +
                '<b>'+item.login+'</b> ('+getHeureMessage(item)+') :<br>' +
                item.content +
                '</div>'
            );
            callback();
        });
    }

</script>
