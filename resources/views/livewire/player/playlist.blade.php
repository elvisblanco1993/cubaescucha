<div>
    @forelse ($episodes as $episode)
        <div class="py-2 border-t border-gray-300 flex justify-between items-center">
            <div class="flex items-center">
                <button
                    class="mr-4 player-btn"
                    id="playing{{$episode->id}}"
                    onclick="play({{$episode->id}}, '{{Storage::disk("s3")->url($episode->file_name)}}')">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>

                <div class="">
                    <small class="text-gray-600 text-xs uppercase">
                        {{ date('M d, Y', strtotime($episode->published_at)) . " | S" .  $episode->season . ':E' . $episode->episode_no}}
                    </small>

                    <p class="font-semibold leading-3">
                        {{ $episode->title }}
                    </p>

                    <div class="text-xs mt-1 w-full">
                        {{ \Illuminate\Support\Str::limit($episode->show_notes, 150, '...') }}
                    </div>

                </div>
            </div>

            <div>
                <a class="text-gray-600 hover:text-yellow-600" href="">
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    @empty

    @endforelse

    <script>
        var player = document.getElementById('player');
        var tmp = localStorage.getItem('tmp');

        // Clears
        localStorage.clear();

        function play(episodeId, url) {
            var episodeBtn = document.getElementById('playing' + episodeId);

            if (tmp == episodeId) {
                if (player.currentTime == 0) {
                    player.src = url;
                }
                // Check if player is currently playing
                if (player.paused) {
                    player.play();
                    episodeBtn.innerHTML = '<svg class="w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                }
                else if (player.ended)
                {
                    player.src = url;
                    player.play();
                    episodeBtn.innerHTML = '<svg class="w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                }
                else {
                    player.pause();
                    episodeBtn.innerHTML = '<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
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
                        btn.innerHTML = '<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                    });
                    episodeBtn.innerHTML = '<svg class="w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                });

                localStorage.clear();
            }

            // Reset play button after an episode is done playing.
            player.addEventListener('ended', ()=> {
                episodeBtn.innerHTML = '<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            });
        }
    </script>
</div>
