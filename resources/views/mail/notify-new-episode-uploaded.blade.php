@component('mail::message')

{{ __("A new episode from ") . $podcast_name . __(" is out now. Click on the button below to start listening.") }}

@component('mail::button', ['url' => route('podcast.display', ['podcast' => $podcast_url])])
{{ __("Go to ") . $podcast_name }}
@endcomponent

{{ __("Thanks") }},<br>

--<br>
Elvis Blanco<br>
eblanco@voicebits.co
@endcomponent
