@component('mail::message')
# {{__("Podcast Import Failed")}}

{{ __("Hi there. I just wanted to let you know that your podcast import process failed. I am investigating the error and will contact you soon.") }}

{{ __("I apologize for any inconveniences.") }}

{{__("Thanks")}},<br>
{{ config('app.name') }}
@endcomponent
