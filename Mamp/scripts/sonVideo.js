/*fonction pour enlever ou remettre le son de la video */
function unmuteVideo(){
	var video = document.getElementById('myVideo');
	var bouton = document.getElementById('boutonSonVideo');

	if (bouton.value == 'Off' ){  /* si le bouton est sur Off */
		bouton.value='On'; /* on change la valeur du bouton sur On */
		bouton.innerHTML='Mute';  /* on change le texte sur le bouton en 'mute' */
		video.volume=0.2;	/* volume video a 0.2 */
		video.muted=false;	/* on enleve le mute */

	} 
	else {
		bouton.value='Off';	/* on met la valeur du bouton sur Off*/
		bouton.innerHTML='Unmute'; /* texte sur le bouton en Unmute */
		video.muted=true;	/* on mute la video */
	}
}