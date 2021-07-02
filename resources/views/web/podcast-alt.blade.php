@extends('layouts.web')
@section('content')

    <div class="max-w-full mx-auto bg-center bg-no-repeat bg-cover" style="background-image: url({{ $thumbnail }})">

        <div class="h-full w-full bg-white bg-opacity-80 text-black backdrop-filter backdrop-blur-lg mx-auto flex items-center justify-center">
            <div class="py-16 sm:flex items-center gap-8 space-y-8 sm:space-y-0">
                <div class="">
                    <img src="{{ $thumbnail }}" alt="" class="w-64 h-64 object-fill rounded-lg">
                </div>
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-extrabold">
                        {{ $name }}
                    </h1>
                    <p class="font-bold text-base text-blueGray-700">
                        {{ $author }}
                    </p>
                    <small class="block text-xs text-blueGray-800 my-4 capitalize">
                        {{ $tags }}
                    </small>
                    <div class="prose text-sm">
                        @parsedown($description)
                    </div>

                    <div class="my-4 flex gap-2 justify-center sm:justify-start">
                        <a  href="{{ route('genRss', ['podcast' => $url]) }}"
                            target="_blank"
                            class="bg-white border p-1 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </a>

                        @isset($spotifypodcasts_url)
                            <a href="{{ $spotifypodcasts_url }}"
                                target="_blank"
                                class="bg-black border p-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" version="1.1" viewBox="0 0 168 168">
                                    <path fill="#1ED760" d="m83.996 0.277c-46.249 0-83.743 37.493-83.743 83.742 0 46.251 37.494 83.741 83.743 83.741 46.254 0 83.744-37.49 83.744-83.741 0-46.246-37.49-83.738-83.745-83.738l0.001-0.004zm38.404 120.78c-1.5 2.46-4.72 3.24-7.18 1.73-19.662-12.01-44.414-14.73-73.564-8.07-2.809 0.64-5.609-1.12-6.249-3.93-0.643-2.81 1.11-5.61 3.926-6.25 31.9-7.291 59.263-4.15 81.337 9.34 2.46 1.51 3.24 4.72 1.73 7.18zm10.25-22.805c-1.89 3.075-5.91 4.045-8.98 2.155-22.51-13.839-56.823-17.846-83.448-9.764-3.453 1.043-7.1-0.903-8.148-4.35-1.04-3.453 0.907-7.093 4.354-8.143 30.413-9.228 68.222-4.758 94.072 11.127 3.07 1.89 4.04 5.91 2.15 8.976v-0.001zm0.88-23.744c-26.99-16.031-71.52-17.505-97.289-9.684-4.138 1.255-8.514-1.081-9.768-5.219-1.254-4.14 1.08-8.513 5.221-9.771 29.581-8.98 78.756-7.245 109.83 11.202 3.73 2.209 4.95 7.016 2.74 10.733-2.2 3.722-7.02 4.949-10.73 2.739z"/>
                                </svg>
                            </a>
                        @endisset

                        @isset($applepodcasts_url)
                            <a href="{{ $applepodcasts_url }}"
                                target="_blank"
                                class="bg-black border p-1 rounded-lg">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M267.429 488.563C262.286 507.573 242.858 512 224 512c-18.857 0-38.286-4.427-43.428-23.437C172.927 460.134 160 388.898 160 355.75c0-35.156 31.142-43.75 64-43.75s64 8.594 64 43.75c0 32.949-12.871 104.179-20.571 132.813zM156.867 288.554c-18.693-18.308-29.958-44.173-28.784-72.599 2.054-49.724 42.395-89.956 92.124-91.881C274.862 121.958 320 165.807 320 220c0 26.827-11.064 51.116-28.866 68.552-2.675 2.62-2.401 6.986.628 9.187 9.312 6.765 16.46 15.343 21.234 25.363 1.741 3.654 6.497 4.66 9.449 1.891 28.826-27.043 46.553-65.783 45.511-108.565-1.855-76.206-63.595-138.208-139.793-140.369C146.869 73.753 80 139.215 80 220c0 41.361 17.532 78.7 45.55 104.989 2.953 2.771 7.711 1.77 9.453-1.887 4.774-10.021 11.923-18.598 21.235-25.363 3.029-2.2 3.304-6.566.629-9.185zM224 0C100.204 0 0 100.185 0 224c0 89.992 52.602 165.647 125.739 201.408 4.333 2.118 9.267-1.544 8.535-6.31-2.382-15.512-4.342-30.946-5.406-44.339-.146-1.836-1.149-3.486-2.678-4.512-47.4-31.806-78.564-86.016-78.187-147.347.592-96.237 79.29-174.648 175.529-174.899C320.793 47.747 400 126.797 400 224c0 61.932-32.158 116.49-80.65 147.867-.999 14.037-3.069 30.588-5.624 47.23-.732 4.767 4.203 8.429 8.535 6.31C395.227 389.727 448 314.187 448 224 448 100.205 347.815 0 224 0zm0 160c-35.346 0-64 28.654-64 64s28.654 64 64 64 64-28.654 64-64-28.654-64-64-64z"/>
                                </svg>
                            </a>
                        @endisset

                        @isset($googlepodcasts_url)
                            <a href="{{ $googlepodcasts_url }}"
                                target="_blank"
                                class="bg-black border p-1 rounded-lg">
                                <svg class="w-6 h-6" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve">
                                    <style type="text/css">.st0{fill:#0066D9;} .st1{fill:#4285F4;} .st2{fill:#EA4335;} .st3{fill:#34A853;} .st4{fill:#FAB908;}</style>
                                    <g>
                                        <path class="st0" d="M15.36,57.25v8.38c0,4.24-3.44,7.68-7.68,7.68S0,69.87,0,65.63v-8.38c0-4.24,3.44-7.68,7.68-7.68 S15.36,53.01,15.36,57.25L15.36,57.25z"></path>
                                        <path class="st1" d="M107.52,57.47c0-0.07,0-0.15,0-0.22c0-4.24,3.44-7.68,7.68-7.68c4.24,0,7.68,3.44,7.68,7.68 c0,0.07,0,0.15,0,0.22l0,0v8.38h0c-0.12,4.14-3.51,7.46-7.68,7.46s-7.56-3.32-7.68-7.46h0L107.52,57.47L107.52,57.47L107.52,57.47 L107.52,57.47z"></path>
                                        <path class="st2" d="M41.89,82.39v8.38c0,4.24-3.44,7.68-7.68,7.68c-4.24,0-7.68-3.44-7.68-7.68v-8.38c0-4.24,3.44-7.68,7.68-7.68 C38.45,74.71,41.89,78.14,41.89,82.39L41.89,82.39L41.89,82.39z M41.89,32.12v27.4h0c-0.09,4.16-3.49,7.51-7.68,7.51 c-4.18,0-7.58-3.34-7.68-7.51h0v-27.4c0-4.24,3.44-7.68,7.68-7.68S41.89,27.87,41.89,32.12L41.89,32.12L41.89,32.12z"></path>
                                        <path class="st3" d="M80.99,40.49c0,4.24,3.44,7.68,7.68,7.68s7.68-3.44,7.68-7.68v-8.38c0-4.24-3.44-7.68-7.68-7.68 c-4.24,0-7.68,3.44-7.68,7.68V40.49L80.99,40.49z"></path>
                                        <path class="st4" d="M53.76,16.06c0,4.24,3.44,7.68,7.68,7.68s7.68-3.44,7.68-7.68V7.68c0-4.24-3.44-7.68-7.68-7.68 s-7.68,3.44-7.68,7.68V16.06L53.76,16.06z M53.76,106.82c0-4.24,3.44-7.68,7.68-7.68s7.68,3.44,7.68,7.68v8.38 c0,4.24-3.44,7.68-7.68,7.68s-7.68-3.44-7.68-7.68V106.82L53.76,106.82z"></path>
                                        <path class="st3" d="M80.99,63.53c0-4.24,3.44-7.68,7.68-7.68s7.68,3.44,7.68,7.68v27.23c0,4.24-3.44,7.68-7.68,7.68 c-4.24,0-7.68-3.44-7.68-7.68V63.53L80.99,63.53z"></path>
                                        <path class="st4" d="M69.12,39.1v44.68c0,4.24-3.44,7.68-7.68,7.68s-7.68-3.44-7.68-7.68V39.1c0-4.24,3.44-7.68,7.68-7.68 S69.12,34.86,69.12,39.1L69.12,39.1z"></path>
                                    </g>
                                </svg>
                            </a>
                        @endisset
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full bg-black bg-opacity-80 text-white backdrop-filter backdrop-blur-lg">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <audio id="player" type="audio/mpeg"></audio>
                <div class="">

                    <input id="player-seeker" type="range" min="0" max="100" value="0" step="1" class="rounded-lg overflow-hidden appearance-none bg-gray-400 h-3 w-full">

                    <div class="flex items-center justify-between">
                        <div class="text-xs w-1/3" id="current-episode-name"></div>

                        <div class="w-1/3 flex justify-center gap-2">
                            <button id="rwBtn" class="hover:text-gray-400">
                                <svg class="w-6 h-6" viewBox="0 0 52 58"  xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="119---Rewind" fill="#fff" fill-rule="nonzero"><path id="Shape" d="m28.283 6.106 3.017-2.587c.8056088-.72612784.8856677-1.96203267.180472-2.78602675s-1.9386364-.93577153-2.780472-.25197325l-7 6c-.4436324.37996855-.6989854.93488888-.6989854 1.519s.255353 1.13903145.6989854 1.519l7 6c.5398529.4865913 1.3011827.6420254 1.9885682.4059887.6873856-.2360366 1.1926248-.8263892 1.3196681-1.5419814.1270434-.7155922-.1441072-1.4437818-.7082363-1.9020073l-2.711-2.323c11.7323859 1.3903499 20.2718899 11.7991628 19.3428789 23.5770612s-10.9948012 20.7191725-22.8000785 20.2529307c-11.8052772-.4662418-21.13455516-10.1735116-21.1318004-21.9879919-.01849603-4.9496865 1.6502081-9.7579247 4.731-13.632.45388963-.5596288.57165908-1.3201496.30829027-1.9908486-.26336882-.6706989-.86715671-1.1478799-1.580562-1.2491376-.7134053-.1012576-1.42612908.1890635-1.86572827.7599862-3.64164256 4.5787427-5.61438283 10.2617019-5.593 16.112-.00301472 14.0634471 11.1770636 25.5801923 25.2344129 25.9942995 14.0573493.4141071 25.895982-10.4245435 26.7208276-24.4637808.8248457-14.0392373-9.6631139-26.18963951-23.6722405-27.4245187z"/><path id="Shape" d="m15.7 15.519c.5398529.4865913 1.3011827.6420254 1.9885682.4059887.6873856-.2360366 1.1926248-.8263892 1.3196681-1.5419814.1270434-.7155922-.1441072-1.4437818-.7082363-1.9020073l-5.227-4.481 5.227-4.481c.8056088-.72612784.8856677-1.96203267.180472-2.78602675s-1.9386364-.93577153-2.780472-.25197325l-7 6c-.4436324.37996855-.6989854.93488888-.6989854 1.519s.255353 1.13903145.6989854 1.519z"/><path id="Shape" d="m16.891 21.336-3 2c-.8950793.5999232-1.1539833 1.8011109-.5855116 2.7164878.5684717.9153768 1.7599419 1.2158463 2.6945116.6795122v13.268h-1c-1.1045695 0-2 .8954305-2 2s.8954305 2 2 2h6c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2h-1v-17c-.0001355-.7374384-.4060631-1.4149703-1.056234-1.7629549-.6501708-.3479847-1.4390817-.3099547-2.052766.0989549z"/><path id="Shape" d="m34 44c2.7614237 0 5-2.2385763 5-5v-13c0-2.7614237-2.2385763-5-5-5h-3c-2.7614237 0-5 2.2385763-5 5v13c0 2.7614237 2.2385763 5 5 5zm-4-5v-13c0-.5522847.4477153-1 1-1h3c.5522847 0 1 .4477153 1 1v13c0 .5522847-.4477153 1-1 1h-3c-.5522847 0-1-.4477153-1-1z"/></g></g></svg>
                            </button>

                            <button id="player-play-pause-btn" onclick="togglePlay()" class="hover:text-gray-400">
                                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                            <button id="ffBtn" class="hover:text-gray-400">
                                <svg class="w-6 h-6" viewBox="0 0 52 58" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="118---Forward" fill="#fff" fill-rule="nonzero" transform="translate(-1 -1)"><path id="Shape" d="m47.407 16.888c-.6895758-.850221-1.9345564-.9880674-2.7934252-.3092928s-1.0124397 1.9219134-.3445748 2.7892928c3.0807919 3.8740753 4.749496 8.6823135 4.731 13.632.0026274 11.8141896-9.3263118 21.5212288-21.1312876 21.9877345-11.8049759.4665058-21.87082731-8.4740955-22.80049193-20.2516507-.92966461-11.7775552 7.60880963-22.1866941 19.34077953-23.5780838l-2.709 2.323c-.8056088.7261278-.8856677 1.9620327-.180472 2.7860268.7051957.823994 1.9386364.9357715 2.780472.2519732l7-6c.4436324-.3799686.6989854-.93488888.6989854-1.519s-.255353-1.13903145-.6989854-1.519l-7-6c-.5398529-.48659126-1.3011827-.64202535-1.9885682-.40598871-.6873856.23603664-1.1926248.82638919-1.3196681 1.5419814-.1270434.71559221.1441072 1.44378185.7082363 1.90200731l3.019 2.587c-14.0095034 1.2338222-24.49848671 13.3838574-23.67431552 27.4234174s12.66271062 24.8788917 26.72035112 24.4650745c14.0576406-.4138171 25.2380745-11.9307622 25.2349644-25.9944919.0213828-5.8502981-1.9513574-11.5332573-5.593-16.112z"/><path id="Shape" d="m34.481 16.3c.3452166.4030142.8364453.6523138 1.3655374.6930132.5290922.0406994 1.0526699-.1305382 1.4554626-.4760132l7-6c.4436324-.3799686.6989854-.93488888.6989854-1.519s-.255353-1.13903145-.6989854-1.519l-7-6c-.5398529-.48659126-1.3011827-.64202535-1.9885682-.40598871-.6873856.23603664-1.1926248.82638919-1.3196681 1.5419814-.1270434.71559221.1441072 1.44378185.7082363 1.90200731l5.225 4.483-5.227 4.481c-.8385691.7181488-.9365954 1.9799573-.219 2.819z"/><path id="Shape" d="m16 41c-1.1045695 0-2 .8954305-2 2s.8954305 2 2 2h6c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2h-1v-17c-.0001355-.7374384-.4060631-1.4149703-1.056234-1.7629549-.6501708-.3479847-1.4390817-.3099547-2.052766.0989549l-3 2c-.8950793.5999232-1.1539833 1.8011109-.5855116 2.7164878.5684717.9153768 1.7599419 1.2158463 2.6945116.6795122v13.268z"/><path id="Shape" d="m32 22c-2.7614237 0-5 2.2385763-5 5v13c0 2.7614237 2.2385763 5 5 5h3c2.7614237 0 5-2.2385763 5-5v-13c0-2.7614237-2.2385763-5-5-5zm4 5v13c0 .5522847-.4477153 1-1 1h-3c-.5522847 0-1-.4477153-1-1v-13c0-.5522847.4477153-1 1-1h3c.5522847 0 1 .4477153 1 1z"/></g></g></svg>
                            </button>
                        </div>

                        <div class="flex items-center gap-4 w-1/3 justify-end">
                            <div class="text-xs sm:text-sm">
                                <span id="curtimetext">00:00</span> / <span id="durtimetext">00:00</span>
                            </div>
                            <button onclick="toggleMute()" id="muteBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    {{-- Cubaescucha Media Player --}}
    <script>
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

            if (player.src === '') {
                document.getElementById('current-episode-name').innerText = "{{__('Please play one of the episode below to get started.')}}";
            } else {
                isPlaying ? player.pause() : player.play();
            }

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

    </script>
    {{-- End: Cubaescucha Media Player --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="my-6">
            @livewire('player.playlist', ['podcast' => $slug, 'episodes' => $episodes])
        </div>
    </div>
@endsection
