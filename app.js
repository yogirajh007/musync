const express = require('express')
const app = express()
const http = require('http').Server(app)
const io = require('socket.io')(http)
const { v4: uuidV4} = require('uuid')
app.set('view engine', 'ejs')
app.use(express.static('public'))


app.get('/', (req, res) => {
res.redirect(`/${uuidV4()}`)	
})

app.get('/:room', (req, res) => {
	res.render('room', { roomId: req.params.room })
})

io.on('connection', socket => {
	socket.on('join-room', (roomId, userId) =>
	{
		socket.join(roomId)
		socket.to(roomId).broadcast.emit('user-connected', userId)
	})
	socket.on('video-paused',(roomId, time) =>
		{
			socket.to(roomId).broadcast.emit('pause-video', time)
		})
socket.on('video-played',(roomId, time) =>
		{
			socket.to(roomId).broadcast.emit('play-video', time)
		})
	socket.on('set-video', (roomId,url,time) =>
		{
		socket.to(roomId).broadcast.emit('set-video', url, time)
		})
})

http.listen(3336, function() {
   console.log('listening on *:3336');
});
