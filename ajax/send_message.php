<script type="text/javascript">
    function send() {
        $('#send_message').prop("disabled",true); // disable button while send message

        var url = '../controllers/c_send_message.php';
        var message = $("#message").val();
        $.ajax({
            type: "POST",
            url: url,
            data: { message: message },
            dataType : 'json'
        }).done(function(data) {
            $("#message").val(''); // clear input value
            $('#send_message').prop("disabled",false); // enable button again
        });
    }
</script>
