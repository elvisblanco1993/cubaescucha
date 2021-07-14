<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <audio
        controls
        class="w-full my-6 rounded-lg"
        id="player"
        type="audio/mpeg"
        src="{{ Storage::disk("s3")->url($episode->file_name) }}"
        >
    </audio>

    <script>
        var player = document.getElementById("player");
        player.onplaying = function () {
            if (player.currentTime == 0) {
                Livewire.emit('playing', {{ $episode->id }});
            }
        }
    </script>
</div>
