<div>
    @forelse ($episodes as $episode)
        {{-- <audio controls src="{{ route('play_episode', ['podcast' => $podcast->url, 'episode' => $episode->file_name]) }}"></audio> --}}
        <div class="block">
            <div class="bg-slate-800 border-2 border-slate-800"></div>
            <div class="bg-slate-800 text-white px-2 py-1 inline-block">
                {{ date('F, d Y', strtotime($episode->published_at)) }}
                <span class="font-black">&centerdot;</span>
                @if ($episode->audio_duration > 60)
                    <span>{{__("about")}}</span>
                    {{ ceil($episode->audio_duration / 60) }}
                    <span>{{__("minutes")}}</span>
                @else
                    <span>{{__("less than a minute")}}</span>
                @endif
            </div>
            <div class="mt-2">
                <a href="" class="text-2xl md:text-3xl font-black text-slate-600 hover:underline">
                    {{$episode->title}}
                </a>
            </div>
            <div class="mt-3 text-lg font-normal">{{$episode->show_notes}}</div>
            <div class="mt-4">
                <button
                    class="player-btn inline-block px-4 py-2 border-2 border-slate-600 hover:border-slate-800 hover:bg-slate-800 font-bold text-slate-600 hover:text-white transition-all"
                    id="playing{{$episode->id}}"
                    onclick="play({{$episode->id}}, '{{route('play_episode', ['podcast'=>$podcast->url, 'episode'=>$episode->file_name])}}', '{{$episode->title}}')">
                    {{__("PLAY EPISODE")}}
                </button>
            </div>
        </div>
        <div class="my-12"></div>
    @empty

    @endforelse

    <script>
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
    </script>
</div>
