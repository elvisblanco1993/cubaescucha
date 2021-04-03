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
                    <p class="font-medium">
                        {{ $episode->title }}
                    </p>
                    <small class="block text-gray-600 uppercase">
                        {{ date('M d, Y', strtotime($episode->created_at)) . " | S" .  $episode->season . ':E' . $episode->episode_no}}
                    </small>
                </div>
            </div>

            <div>
                <a class="text-gray-600" href="{{Storage::disk('s3')->url($episode->file_name)}}" download="{{$episode->file_name}}">
                    <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
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
        }
    </script>
</div>
