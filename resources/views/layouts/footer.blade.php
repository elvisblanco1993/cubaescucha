<div class="bg-blueGray-900 text-blueGray-200">
    <div class="max-w-7xl mx-auto py-6 sm:flex items-center justify-between px-4 md:px-8 text-center">
        {{-- Left side --}}
        <div class="w-full sm:w-1/2 text-sm sm:text-left font-light py-3">
            <span class="mr-4">
                {{ 'Copyright © ' . Carbon\Carbon::now()->year . " cubaescucha.com" }}
            </span>
            <div class="uppercase bg-blueGray-700 inline-block rounded">
                @foreach(config('app.languages') as $langLocale => $langName)
                    <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="px-2 py-1 rounded @if (app()->getLocale() == $langLocale) bg-emerald-600 @endif">{{ $langLocale }}</a>
                @endforeach
            </div>
        </div>

        <div class="w-full sm:w-1/2 text-sm font-light text-center sm:text-right py-3">
            <a href="{{ config('app.url') . '/help' }}" class="mx-2">{{ __('Help') }}</a>
            <a href="{{ config('app.url') . '/privacy-policy' }}" class="mx-2">{{ __('Privacy') }}</a>
            <a href="{{ config('app.url') . '/terms-of-service' }}" class="mx-2">{{ __('Terms') }}</a>
            <a href="{{ config('app.url') . '/donate' }}" target="__blank" class="ml-2 px-2 py-1 bg-yellow-400 rounded text-blueGray-900">{{ __('Donate') }}</a>
        </div>
    </div>
</div>
