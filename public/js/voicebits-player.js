// Player Script
var playerPlayPauseBtn = document.getElementById('player-play-pause-btn');
var seeker = document.getElementById('player-seeker');
var ff = document.getElementById('ffBtn');
var rw = document.getElementById('rwBtn');
var muteBtn = document.getElementById('muteBtn');
var curtimetext = document.getElementById("curtimetext");
var durtimetext = document.getElementById("durtimetext");
var isPlaying = false;
var seeking = false;
var seekto;
seeker.value = 0;
player.addEventListener('ended', ()=>{
    seeker.value = 0;
    playerPlayPauseBtn.innerHTML = '<svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
});
player.addEventListener('timeupdate', ()=>{
    seekTimeUpdate();
});
// Seeker Events
seeker.addEventListener('change', ()=>{
    player.currentTime = seeker.value;
    seeker.max = player.duration;
});
seeker.addEventListener('mouseup', ()=>{
    seeking = false;
});
// FF and RW Events
rw.addEventListener('click', ()=>{
    player.currentTime = player.currentTime - 10;
});
ff.addEventListener('click', ()=>{
    player.currentTime = player.currentTime + 10;
});
// Play toggle
function togglePlay(){
    isPlaying ? player.pause() : player.play();
}
// Mute toggle
function toggleMute(){
    player.muted = !player.muted;
    if (player.muted === true) {
        muteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" clip-rule="evenodd" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" /></svg>';
    } else {
        muteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>';
    }
}
function seekTimeUpdate(){
    seeker.value = player.currentTime;
    var curmins = Math.floor(player.currentTime / 60);
    var cursecs = Math.floor(player.currentTime - curmins * 60);
    var durmins = Math.floor(player.duration / 60);
    var dursecs = Math.floor(player.duration - durmins * 60);
    if(cursecs < 10){ cursecs = "0"+cursecs; }
    if(dursecs < 10){ dursecs = "0"+dursecs; }
    if(curmins < 10){ curmins = "0"+curmins; }
    if(durmins < 10){ durmins = "0"+durmins; }
    curtimetext.innerHTML = curmins+":"+cursecs;
    durtimetext.innerHTML = durmins+":"+dursecs;
    if (player.currentTime > 0 && player.currentTime < 2) {
        seeker.max = player.duration;
    }
}
// Change play button icon
player.onplaying = function(){
    isPlaying = true;
    playerPlayPauseBtn.innerHTML = '<svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
}
// Change play button icon
player.onpause = function(){
    isPlaying = false;
    playerPlayPauseBtn.innerHTML = '<svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
}
