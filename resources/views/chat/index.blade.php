@extends('layouts.app')

@section('content')
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>

Message List:
<pre id="message-list">
</pre>

<input id="message" />
<button id="send">Send</button>

<script>
    var socket = io.connect('http://localhost:8890');

    socket.on('message', (data) => {
        console.log(data);
        $("#message-list").append(data.message +"\n");
    });

    $("#send").click(() => {
        $.ajax({
            type: "POST",
            url: "{!! action('ChatController@sendMessage') !!}",
            data: {
                message: $("#message").val(),
            },
            success: (data) => {
                $("#message").val('');
            }
        });
    })
</script>
@endsection
