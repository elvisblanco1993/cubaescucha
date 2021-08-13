@component('mail::message')
# {{__("Please validate your RSS feed URL")}}

{{ __("Hi there. Please copy the code below into your browser to continue importing your podcast.") }}

<strong>{{ $code }}</strong><br>

{{ __("Thanks") }},<br>

--<br>
Elvis Blanco<br>
eblanco@voicebits.co
@endcomponent
