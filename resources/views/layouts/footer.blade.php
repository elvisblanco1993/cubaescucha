<div class="bg-gray-100 text-gray-800 bottom-0 w-full flex justify-center">
    @foreach(config('app.languages') as $langLocale => $langName)
        <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
    @endforeach
    {!! __('cubaescucha.com') !!}
</div>
