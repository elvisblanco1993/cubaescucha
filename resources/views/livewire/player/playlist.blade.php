<div>
    @forelse ($episodes as $episode)
        <div x-data="{expanded: false}" class="py-4 px-2 border my-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    {{-- Play episode button --}}
                    <button
                        class="mr-4 player-btn"
                        id="playing{{$episode->id}}"
                        onclick="play({{$episode->id}}, '{{Storage::disk("s3")->url($episode->file_name)}}', '{{$episode->title}}')">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>

                    {{-- Episode information --}}
                    <div class="flex flex-col justify-center">
                        <small class="text-gray-600 text-xs">
                            {{ date('M d, Y', strtotime($episode->published_at)) }} /
                            @if ($episode->season != null)
                                {{ " | S" .  $episode->season }}
                            @endif
                            {{'E' . $episode->episode_no}}

                            @if( $episode->explicit == 1 )
                                <span class="ml-2 bg-black px-1 text-yellow-400 font-bold">{{__("explicit")}}</span>
                            @endif
                        </small>

                        <p class="font-semibold leading-3">
                            {{ $episode->title }}
                        </p>
                    </div>
                </div>

                <div>
                    <button class="text-gray-600 hover:text-yellow-500" @click="expanded = !expanded">
                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div x-show="expanded" x-cloak x-collapse.duration.1000ms class="text-sm w-full prose-2xl prose-indigo pt-4">
                {!!$episode->show_notes!!}
            </div>
        </div>
    @empty

    @endforelse

    <script>
        var player = document.getElementById('player');
        var currentEpisodeTitle = document.getElementById('current-episode-name') ?? null;
        var tmp = localStorage.getItem('tmp');

        var playIcon = '<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
        var pauseIcon = '<svg class="w-8 h-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';

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
                    episodeBtn.innerHTML = pauseIcon;
                }
                else if (player.ended)
                {
                    player.src = url;
                    player.play();
                    episodeBtn.innerHTML = pauseIcon;
                }
                else {
                    player.pause();
                    episodeBtn.innerHTML = playIcon;
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
                        btn.innerHTML = playIcon;
                    });
                    episodeBtn.innerHTML = pauseIcon;
                });

                localStorage.clear();
            }

            // Reset play button after an episode is done playing.
            player.addEventListener('ended', ()=> {
                episodeBtn.innerHTML = playIcon;
            });
        }
    </script>
</div>
