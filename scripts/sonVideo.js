function unmuteVideo(){
	var video = document.getElementById('myVideo');
	var bouton = document.getElementById('boutonSonVideo');

	if (bouton.value == 'Off' ){
		bouton.value='On';
		bouton.innerHTML='Mute';
		video.volume=0.4;
		video.muted=false;

	} 
	else {
		bouton.value='Off';
		bouton.innerHTML='Unmute';
		video.muted=true;
	}
}