@extends('layouts.podcast', ['name' => $podcast->name, 'description' => $podcast->description, 'thumbnail' => $podcast->thumbnail])
@section('content')
    {{-- Player --}}
    <div class="fixed bottom-0 w-full bg-slate-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <audio id="player" type="audio/mpeg"></audio>
            <div class="flex items-center gap-2">
                <button id="rwBtn" class="text-gray-200 hover:text-white">
                    <svg class="w-6 h-6" viewBox="0 0 52 58"  xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="119---Rewind" fill="#fff" fill-rule="nonzero"><path id="Shape" d="m28.283 6.106 3.017-2.587c.8056088-.72612784.8856677-1.96203267.180472-2.78602675s-1.9386364-.93577153-2.780472-.25197325l-7 6c-.4436324.37996855-.6989854.93488888-.6989854 1.519s.255353 1.13903145.6989854 1.519l7 6c.5398529.4865913 1.3011827.6420254 1.9885682.4059887.6873856-.2360366 1.1926248-.8263892 1.3196681-1.5419814.1270434-.7155922-.1441072-1.4437818-.7082363-1.9020073l-2.711-2.323c11.7323859 1.3903499 20.2718899 11.7991628 19.3428789 23.5770612s-10.9948012 20.7191725-22.8000785 20.2529307c-11.8052772-.4662418-21.13455516-10.1735116-21.1318004-21.9879919-.01849603-4.9496865 1.6502081-9.7579247 4.731-13.632.45388963-.5596288.57165908-1.3201496.30829027-1.9908486-.26336882-.6706989-.86715671-1.1478799-1.580562-1.2491376-.7134053-.1012576-1.42612908.1890635-1.86572827.7599862-3.64164256 4.5787427-5.61438283 10.2617019-5.593 16.112-.00301472 14.0634471 11.1770636 25.5801923 25.2344129 25.9942995 14.0573493.4141071 25.895982-10.4245435 26.7208276-24.4637808.8248457-14.0392373-9.6631139-26.18963951-23.6722405-27.4245187z"/><path id="Shape" d="m15.7 15.519c.5398529.4865913 1.3011827.6420254 1.9885682.4059887.6873856-.2360366 1.1926248-.8263892 1.3196681-1.5419814.1270434-.7155922-.1441072-1.4437818-.7082363-1.9020073l-5.227-4.481 5.227-4.481c.8056088-.72612784.8856677-1.96203267.180472-2.78602675s-1.9386364-.93577153-2.780472-.25197325l-7 6c-.4436324.37996855-.6989854.93488888-.6989854 1.519s.255353 1.13903145.6989854 1.519z"/><path id="Shape" d="m16.891 21.336-3 2c-.8950793.5999232-1.1539833 1.8011109-.5855116 2.7164878.5684717.9153768 1.7599419 1.2158463 2.6945116.6795122v13.268h-1c-1.1045695 0-2 .8954305-2 2s.8954305 2 2 2h6c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2h-1v-17c-.0001355-.7374384-.4060631-1.4149703-1.056234-1.7629549-.6501708-.3479847-1.4390817-.3099547-2.052766.0989549z"/><path id="Shape" d="m34 44c2.7614237 0 5-2.2385763 5-5v-13c0-2.7614237-2.2385763-5-5-5h-3c-2.7614237 0-5 2.2385763-5 5v13c0 2.7614237 2.2385763 5 5 5zm-4-5v-13c0-.5522847.4477153-1 1-1h3c.5522847 0 1 .4477153 1 1v13c0 .5522847-.4477153 1-1 1h-3c-.5522847 0-1-.4477153-1-1z"/></g></g></svg>
                </button>
                <button id="player-play-pause-btn" onclick="togglePlay()" class="text-gray-200 hover:text-white">
                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <button id="ffBtn" class="text-gray-200 hover:text-white">
                    <svg class="w-6 h-6" viewBox="0 0 52 58" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="118---Forward" fill="#fff" fill-rule="nonzero" transform="translate(-1 -1)"><path id="Shape" d="m47.407 16.888c-.6895758-.850221-1.9345564-.9880674-2.7934252-.3092928s-1.0124397 1.9219134-.3445748 2.7892928c3.0807919 3.8740753 4.749496 8.6823135 4.731 13.632.0026274 11.8141896-9.3263118 21.5212288-21.1312876 21.9877345-11.8049759.4665058-21.87082731-8.4740955-22.80049193-20.2516507-.92966461-11.7775552 7.60880963-22.1866941 19.34077953-23.5780838l-2.709 2.323c-.8056088.7261278-.8856677 1.9620327-.180472 2.7860268.7051957.823994 1.9386364.9357715 2.780472.2519732l7-6c.4436324-.3799686.6989854-.93488888.6989854-1.519s-.255353-1.13903145-.6989854-1.519l-7-6c-.5398529-.48659126-1.3011827-.64202535-1.9885682-.40598871-.6873856.23603664-1.1926248.82638919-1.3196681 1.5419814-.1270434.71559221.1441072 1.44378185.7082363 1.90200731l3.019 2.587c-14.0095034 1.2338222-24.49848671 13.3838574-23.67431552 27.4234174s12.66271062 24.8788917 26.72035112 24.4650745c14.0576406-.4138171 25.2380745-11.9307622 25.2349644-25.9944919.0213828-5.8502981-1.9513574-11.5332573-5.593-16.112z"/><path id="Shape" d="m34.481 16.3c.3452166.4030142.8364453.6523138 1.3655374.6930132.5290922.0406994 1.0526699-.1305382 1.4554626-.4760132l7-6c.4436324-.3799686.6989854-.93488888.6989854-1.519s-.255353-1.13903145-.6989854-1.519l-7-6c-.5398529-.48659126-1.3011827-.64202535-1.9885682-.40598871-.6873856.23603664-1.1926248.82638919-1.3196681 1.5419814-.1270434.71559221.1441072 1.44378185.7082363 1.90200731l5.225 4.483-5.227 4.481c-.8385691.7181488-.9365954 1.9799573-.219 2.819z"/><path id="Shape" d="m16 41c-1.1045695 0-2 .8954305-2 2s.8954305 2 2 2h6c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2h-1v-17c-.0001355-.7374384-.4060631-1.4149703-1.056234-1.7629549-.6501708-.3479847-1.4390817-.3099547-2.052766.0989549l-3 2c-.8950793.5999232-1.1539833 1.8011109-.5855116 2.7164878.5684717.9153768 1.7599419 1.2158463 2.6945116.6795122v13.268z"/><path id="Shape" d="m32 22c-2.7614237 0-5 2.2385763-5 5v13c0 2.7614237 2.2385763 5 5 5h3c2.7614237 0 5-2.2385763 5-5v-13c0-2.7614237-2.2385763-5-5-5zm4 5v13c0 .5522847-.4477153 1-1 1h-3c-.5522847 0-1-.4477153-1-1v-13c0-.5522847.4477153-1 1-1h3c.5522847 0 1 .4477153 1 1z"/></g></g></svg>
                </button>

                <input id="player-seeker" type="range" min="0" max="100" value="0" step="1" class="rounded-lg overflow-hidden appearance-none h-1 bg-gray-600 w-full">

                <div class="text-white flex items-center gap-1">
                    <span id="curtimetext" class="text-xs sm:text-sm">00:00</span> / <span id="durtimetext" class="text-xs sm:text-sm">00:00</span>
                </div>
                <button onclick="toggleMute()" id="muteBtn" class="text-gray-200 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
        <div class="hidden sm:grid sm:grid-cols-3">
            <div class="flex items-center">
                <a href="" class="font-bold text-slate-800 tracking-wide">{{__("HOME")}}</a>
                <a href="" class="ml-4 font-bold text-slate-800 tracking-wide">{{__("ABOUT")}}</a>
            </div>
            <div class="md:flex items-center justify-center">
                <img src="{{asset('covers/'.$podcast->thumbnail)}}" alt="" class="h-36 w-36 object-cover rounded-lg">
            </div>
            <div class="flex items-center justify-end">
                <a href="" class="font-bold text-slate-800 tracking-wide">{{__("EPISODES")}}</a>
                <a href="" class="ml-4 font-bold text-slate-800 tracking-wide">{{__("SUBSCRIBE")}}</a>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div class="flex gap-4 items-center sm:hidden">
            <a href="">
                <img src="{{asset('covers/'.$podcast->thumbnail)}}" alt="" class="h-16 w-16 object-cover rounded-md">
            </a>
            <a href="" class="font-bold text-slate-800 tracking-wide">{{__("ABOUT")}}</a>
            <a href="" class="font-bold text-slate-800 tracking-wide">{{__("EPISODES")}}</a>
            <a href="" class="font-bold text-slate-800 tracking-wide">{{__("SUBSCRIBE")}}</a>
        </div>

        <div class="mt-12 text-lg mdtext-2xl font-normal text-justify text-slate-800">
            {{$podcast->description}}
        </div>
        <div class="mt-12 block">
            @livewire('podcast.player', ['podcast_id' => $podcast->id])
        </div>
    </div>

    {{-- voicebits Media Player --}}
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
                // document.getElementById('current-episode-name').innerText = "{{__('Please play one of the episode below to get started.')}}";
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
    {{-- End: voicebits Media Player --}}
@endsection
