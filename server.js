var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890);

io.on('connection', function (socket) {
  console.log("client connected " + socket.id);

  var redisClient = redis.createClient();
  redisClient.subscribe('message');

  redisClient.on("message", function(channel, event) {
    var data = JSON.parse(event)["data"];
    console.log("client " + socket.id + " has new message: " + data['message']);

    socket.emit(channel, data);
  });

  socket.on('disconnect', function() {
    console.log("client disconnected");
    redisClient.quit();
  });
});
