var voicebits_player = document.getElementById('voicebits-player');
var voicebits_player_container = document.getElementById('voicebits-player-container');

// Right container
var voicebits_player_right_container = document.createElement('div');
voicebits_player_right_container.setAttribute('id', 'voicebits_player_right_container');

// Title Container
var voicebits_title_container = document.createElement('div');
voicebits_title_container.setAttribute('id', 'voicebits_title_container');

// Controls Container
var voicebits_player_controls = document.createElement('div');
voicebits_player_controls.setAttribute('id', 'voicebits_player_controls');

// Controls Left
var voicebits_player_controls_left = document.createElement('div');
voicebits_player_controls_left.setAttribute('id', 'voicebits_player_controls_left');

// Controls Right
var voicebits_player_controls_right = document.createElement('div');
voicebits_player_controls_right.setAttribute('id', 'voicebits_player_controls_right');

// Play btn
var voicebits_play_btn = document.createElement('button');
voicebits_play_btn.setAttribute('id', 'voicebits_play_btn');
voicebits_play_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>';

// Fast forward btn
var voicebits_ff_btn = document.createElement('button');
voicebits_ff_btn.setAttribute('id', 'voicebits_ff_btn');
voicebits_ff_btn.innerHTML = '<svg viewBox="0 0 52 58" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="118---Forward" fill="#fff" fill-rule="nonzero" transform="translate(-1 -1)"><path id="Shape" d="m47.407 16.888c-.6895758-.850221-1.9345564-.9880674-2.7934252-.3092928s-1.0124397 1.9219134-.3445748 2.7892928c3.0807919 3.8740753 4.749496 8.6823135 4.731 13.632.0026274 11.8141896-9.3263118 21.5212288-21.1312876 21.9877345-11.8049759.4665058-21.87082731-8.4740955-22.80049193-20.2516507-.92966461-11.7775552 7.60880963-22.1866941 19.34077953-23.5780838l-2.709 2.323c-.8056088.7261278-.8856677 1.9620327-.180472 2.7860268.7051957.823994 1.9386364.9357715 2.780472.2519732l7-6c.4436324-.3799686.6989854-.93488888.6989854-1.519s-.255353-1.13903145-.6989854-1.519l-7-6c-.5398529-.48659126-1.3011827-.64202535-1.9885682-.40598871-.6873856.23603664-1.1926248.82638919-1.3196681 1.5419814-.1270434.71559221.1441072 1.44378185.7082363 1.90200731l3.019 2.587c-14.0095034 1.2338222-24.49848671 13.3838574-23.67431552 27.4234174s12.66271062 24.8788917 26.72035112 24.4650745c14.0576406-.4138171 25.2380745-11.9307622 25.2349644-25.9944919.0213828-5.8502981-1.9513574-11.5332573-5.593-16.112z"/><path id="Shape" d="m34.481 16.3c.3452166.4030142.8364453.6523138 1.3655374.6930132.5290922.0406994 1.0526699-.1305382 1.4554626-.4760132l7-6c.4436324-.3799686.6989854-.93488888.6989854-1.519s-.255353-1.13903145-.6989854-1.519l-7-6c-.5398529-.48659126-1.3011827-.64202535-1.9885682-.40598871-.6873856.23603664-1.1926248.82638919-1.3196681 1.5419814-.1270434.71559221.1441072 1.44378185.7082363 1.90200731l5.225 4.483-5.227 4.481c-.8385691.7181488-.9365954 1.9799573-.219 2.819z"/><path id="Shape" d="m16 41c-1.1045695 0-2 .8954305-2 2s.8954305 2 2 2h6c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2h-1v-17c-.0001355-.7374384-.4060631-1.4149703-1.056234-1.7629549-.6501708-.3479847-1.4390817-.3099547-2.052766.0989549l-3 2c-.8950793.5999232-1.1539833 1.8011109-.5855116 2.7164878.5684717.9153768 1.7599419 1.2158463 2.6945116.6795122v13.268z"/><path id="Shape" d="m32 22c-2.7614237 0-5 2.2385763-5 5v13c0 2.7614237 2.2385763 5 5 5h3c2.7614237 0 5-2.2385763 5-5v-13c0-2.7614237-2.2385763-5-5-5zm4 5v13c0 .5522847-.4477153 1-1 1h-3c-.5522847 0-1-.4477153-1-1v-13c0-.5522847.4477153-1 1-1h3c.5522847 0 1 .4477153 1 1z"/></g></g></svg>';

// Rewind btn
var voicebits_rw_btn = document.createElement('button');
voicebits_rw_btn.setAttribute('id', 'voicebits_rw_btn');
voicebits_rw_btn.innerHTML = '<svg viewBox="0 0 52 58"  xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="119---Rewind" fill="#fff" fill-rule="nonzero"><path id="Shape" d="m28.283 6.106 3.017-2.587c.8056088-.72612784.8856677-1.96203267.180472-2.78602675s-1.9386364-.93577153-2.780472-.25197325l-7 6c-.4436324.37996855-.6989854.93488888-.6989854 1.519s.255353 1.13903145.6989854 1.519l7 6c.5398529.4865913 1.3011827.6420254 1.9885682.4059887.6873856-.2360366 1.1926248-.8263892 1.3196681-1.5419814.1270434-.7155922-.1441072-1.4437818-.7082363-1.9020073l-2.711-2.323c11.7323859 1.3903499 20.2718899 11.7991628 19.3428789 23.5770612s-10.9948012 20.7191725-22.8000785 20.2529307c-11.8052772-.4662418-21.13455516-10.1735116-21.1318004-21.9879919-.01849603-4.9496865 1.6502081-9.7579247 4.731-13.632.45388963-.5596288.57165908-1.3201496.30829027-1.9908486-.26336882-.6706989-.86715671-1.1478799-1.580562-1.2491376-.7134053-.1012576-1.42612908.1890635-1.86572827.7599862-3.64164256 4.5787427-5.61438283 10.2617019-5.593 16.112-.00301472 14.0634471 11.1770636 25.5801923 25.2344129 25.9942995 14.0573493.4141071 25.895982-10.4245435 26.7208276-24.4637808.8248457-14.0392373-9.6631139-26.18963951-23.6722405-27.4245187z"/><path id="Shape" d="m15.7 15.519c.5398529.4865913 1.3011827.6420254 1.9885682.4059887.6873856-.2360366 1.1926248-.8263892 1.3196681-1.5419814.1270434-.7155922-.1441072-1.4437818-.7082363-1.9020073l-5.227-4.481 5.227-4.481c.8056088-.72612784.8856677-1.96203267.180472-2.78602675s-1.9386364-.93577153-2.780472-.25197325l-7 6c-.4436324.37996855-.6989854.93488888-.6989854 1.519s.255353 1.13903145.6989854 1.519z"/><path id="Shape" d="m16.891 21.336-3 2c-.8950793.5999232-1.1539833 1.8011109-.5855116 2.7164878.5684717.9153768 1.7599419 1.2158463 2.6945116.6795122v13.268h-1c-1.1045695 0-2 .8954305-2 2s.8954305 2 2 2h6c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2h-1v-17c-.0001355-.7374384-.4060631-1.4149703-1.056234-1.7629549-.6501708-.3479847-1.4390817-.3099547-2.052766.0989549z"/><path id="Shape" d="m34 44c2.7614237 0 5-2.2385763 5-5v-13c0-2.7614237-2.2385763-5-5-5h-3c-2.7614237 0-5 2.2385763-5 5v13c0 2.7614237 2.2385763 5 5 5zm-4-5v-13c0-.5522847.4477153-1 1-1h3c.5522847 0 1 .4477153 1 1v13c0 .5522847-.4477153 1-1 1h-3c-.5522847 0-1-.4477153-1-1z"/></g></g></svg>';

// Set the episode title
var voicebits_player_title = document.createElement('div');
voicebits_player_title.setAttribute('id', 'voicebits_player_title');
voicebits_player_title.innerText = voicebits_player_container.getAttribute('episode-title');

// Set episode owner
var voicebits_player_owner = document.createElement('div');
voicebits_player_owner.setAttribute('id', 'voicebits_player_owner');
voicebits_player_owner.innerText = voicebits_player_container.getAttribute('episode-owner');

// Set podcast url
var voicebits_podcast_url = document.createElement('a');
voicebits_podcast_url.setAttribute('id', 'voicebits_podcast_url');
voicebits_podcast_url.setAttribute('href', voicebits_player_container.getAttribute('podcast-url'));
voicebits_podcast_url.setAttribute('target', '_blank');
voicebits_podcast_url.setAttribute('title', 'Go to podcast website');
voicebits_podcast_url.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>';

// Timer
var voicebits_timer = document.createElement('span');
voicebits_timer.setAttribute('id', 'voicebits_timer');
var voicebits_timer_separator = document.createElement('span');
voicebits_timer_separator.innerText = '/';
voicebits_timer_separator.setAttribute('id', 'voicebits_timer_separator');
var voicebits_current_time = document.createElement('span');
var voicebits_total_time = document.createElement('span');

// Styling
var styles = document.createElement('style');

styles.innerHTML = `
    #voicebits-player-container {
        border-radius: 0.5rem !important;
        background-color: #2b3036;
        color: white;
        display: flex !important;
        align-items: center !important;
    }

    #voicebits-player-img {
        border-radius: 0.5rem 0 0 0.5rem !important;
        width: 8rem !important;
        height: 8rem !important;
        object-fit: cover;
    }

    #voicebits_player_right_container {
        margin-left: 2rem;
        margin-right: 2rem;
        font-family: sans-serif;
        width: 100%;
    }

    #voicebits_player_owner {
        margin-top: 0.5rem;
        font-size: 0.8rem;
    }

    #voicebits_player_title {
        margin-top: .6rem;
    }

    #voicebits_player_controls {
        margin-top: 1rem;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    #voicebits_player_controls_left {
        display: flex !important;
        align-items: center !important;
    }

    #voicebits_play_btn {
        border: none;
        background: none;
        padding: 0 !important;
    }

    #voicebits_play_btn:hover {
        cursor: pointer;
    }

    #voicebits_play_btn > svg {
        width: 2.5rem;
        color: #ffffff;
        margin: 0 0.5rem;
    }

    #voicebits_ff_btn {
        border: none;
        background: none;
        padding: 0 !important;
    }

    #voicebits_ff_btn:hover {
        cursor: pointer;
    }

    #voicebits_ff_btn > svg {
        width: 1rem;
        color: #ffffff;
    }

    #voicebits_rw_btn {
        border: none;
        background: none;
        padding: 0 !important;
    }

    #voicebits_rw_btn:hover {
        cursor: pointer;
    }

    #voicebits_rw_btn > svg {
        width: 1rem;
        color: #ffffff;
    }

    #voicebits_podcast_url > svg {
        width: 1.2rem;
        height: 1.2rem;
        color: white;
    }

    #voicebits_timer {
        margin-left: 2rem;
        font-size: .8rem;
    }

    #voicebits_timer_separator {
        margin: 0 .2rem;
    }
`;

voicebits_player_container.appendChild(voicebits_title_container);
voicebits_player_container.appendChild(voicebits_player_right_container);
voicebits_player_right_container.appendChild(voicebits_title_container);
voicebits_title_container.appendChild(voicebits_player_owner);
voicebits_title_container.appendChild(voicebits_player_title);

voicebits_player_right_container.appendChild(voicebits_player_controls);
voicebits_player_controls.appendChild(voicebits_player_controls_left);
voicebits_player_controls_left.appendChild(voicebits_rw_btn);
voicebits_player_controls_left.appendChild(voicebits_play_btn);
voicebits_player_controls_left.appendChild(voicebits_ff_btn);
voicebits_player_controls_left.appendChild(voicebits_timer);
voicebits_timer.appendChild(voicebits_current_time);
voicebits_timer.appendChild(voicebits_timer_separator);
voicebits_timer.appendChild(voicebits_total_time);
voicebits_current_time.innerText = voicebits_total_time.innerText = '00:00';


voicebits_player_controls.appendChild(voicebits_player_controls_right);
voicebits_player_controls_right.appendChild(voicebits_podcast_url);


document.body.appendChild(styles);

// Player behavior here
var isPlaying = false;

voicebits_player.addEventListener('ended', ()=>{
    voicebits_play_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16"><path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z"/></svg>';
});

// FF and RW Events
voicebits_rw_btn.addEventListener('click', ()=>{
    voicebits_player.currentTime = voicebits_player.currentTime - 10;
});

voicebits_ff_btn.addEventListener('click', ()=>{
    voicebits_player.currentTime = voicebits_player.currentTime + 10;
});

// Play / pause
voicebits_play_btn.addEventListener('click', ()=>{
    isPlaying ? voicebits_player.pause() : voicebits_player.play();
});

// Change play button icon
voicebits_player.onplaying = function(){
    isPlaying = true;
    voicebits_play_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16"><path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z"/></svg>';
}

// Change play button icon
voicebits_player.onpause = function(){
    isPlaying = false;
    voicebits_play_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>';
}

voicebits_player.addEventListener('timeupdate', ()=>{
    seekTimeUpdate();
});

function seekTimeUpdate(){
    var curmins = Math.floor(voicebits_player.currentTime / 60);
    var cursecs = Math.floor(voicebits_player.currentTime - curmins * 60);
    var durmins = Math.floor(voicebits_player.duration / 60);
    var dursecs = Math.floor(voicebits_player.duration - durmins * 60);
    if(cursecs < 10){ cursecs = "0"+cursecs; }
    if(dursecs < 10){ dursecs = "0"+dursecs; }
    if(curmins < 10){ curmins = "0"+curmins; }
    if(durmins < 10){ durmins = "0"+durmins; }
    voicebits_current_time.innerHTML = curmins+":"+cursecs;
    voicebits_total_time.innerHTML = durmins+":"+dursecs;
}
