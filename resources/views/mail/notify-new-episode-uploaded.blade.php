@component('mail::message')

{{ __("A new episode from ") . $podcast_name . __(" is out now. Click on the button below to start listening.") }}

@component('mail::button', ['url' => route('podcast.display', ['podcast' => $podcast_url])])
{{ __("Go to ") . $podcast_name }}
@endcomponent

{{__("Best")}},<br>
{{ $podcast_name . __(" team.") }}
@endcomponent
