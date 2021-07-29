@component('mail::message')
# {{__("Your Podcast is Ready")}}!

{{ __("Hi there. I just wanted to let you know that your podcast was successfully imported and is readily available now.") }}

@component('mail::button', ['url' => route('podcasts')])
{{__("Go to podcast")}}
@endcomponent

{{__("Thanks")}},<br>
{{ __("Elvis") }}<br>
{{__("The creator of")}} [cubaescucha.com](https://cubaescucha.com)
@endcomponent
