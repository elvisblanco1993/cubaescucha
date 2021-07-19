@component('mail::message')
# {{__("New episode available now!")}}!

{{ __("Hi there. We have just released a new episode of your favorite podcast, ") . $podcast_name . __(" is out.") }}

@component('mail::button', ['url' => route('podcast.display', ['podcast' => $podcast_url])])
{{ __("Go to ") . $podcast_name }}
@endcomponent

{{__("Thank you for being a loyal listener")}},<br>
{{ $podcast_name . __(" team.") }}
@endcomponent
