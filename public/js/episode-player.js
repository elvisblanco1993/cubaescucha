var player = document.getElementById('player');
var currentEpisodeTitle = document.getElementById('current-episode-name') ?? null;
var tmp = localStorage.getItem('tmp');
// Clears
localStorage.clear();
function play(episodeId, url, title) {
    var episodeBtn = document.getElementById('playing' + episodeId);
    if (currentEpisodeTitle !== null) {
        currentEpisodeTitle.innerText = title;
    }
    if (tmp == episodeId) {
        if (player.currentTime == 0) {
            player.src = url;
        }
        // Check if player is currently playing
        if (player.paused) {
            player.play();
            episodeBtn.innerHTML = 'PLAYING';
        }
        else if (player.ended)
        {
            player.src = url;
            player.play();
            episodeBtn.innerHTML = 'PLAYING';
        }
        else {
            player.pause();
            episodeBtn.innerHTML = 'PLAY EPISODE';
        }
    } else {
        // Reset status of all episodes player-btn
        var playerBtns = document.querySelectorAll('.player-btn');
        localStorage.clear();
        localStorage.setItem('tmp', episodeId);
        tmp = localStorage.getItem('tmp');
        player.src = url;
        Livewire.emit('playing', tmp);
        Livewire.on('continue', () => {
            player.play();
            playerBtns.forEach(btn => {
                btn.innerHTML = 'PLAY EPISODE';
            });
            episodeBtn.innerHTML = 'PLAYING';
        });
        localStorage.clear();
    }
    // Reset play button after an episode is done playing.
    player.addEventListener('ended', ()=> {
        episodeBtn.innerHTML = 'PLAY EPISODE';
    });
}
