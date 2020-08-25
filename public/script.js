const socket = io('/')

socket.emit('join-room', ROOM_ID, 10)


socket.on('user-connected', userId =>
{
console.log(userId)
socket.emit('set-video', ROOM_ID ,vid_url, x.currentTime )
})



socket.on('pause-video',(time) =>
	{
	console.log("Please pause video")
	x.pause();
	y.pause();
	//x.currentTime = time;
	})

socket.on('play-video',(time) =>
	{
	console.log("Please play video")
	x.play();
	y.pause();
	//x.currentTime = time;
	})

socket.on('set-video', (url,time) =>
	{
	console.log(url)
	getvalue(url,time);
	})
