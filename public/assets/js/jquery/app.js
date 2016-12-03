(function(){
    var pusher = new Pusher('7d423c90aa6bd61758af', {
        encrypted: true
    });

    var channel = pusher.subscribe('demoChannel');
    channel.bind('userLinkedPost', function(data) {
        console.log(data.message);
    });
});
