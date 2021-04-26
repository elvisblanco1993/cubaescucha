<div class="mt-12 sm:flex items-center justify-between mx-4 md:mx-8 text-blueGray-800">

    {{-- Left side --}}
    <div class="w-full sm:w-1/2 text-sm font-light py-3">
        <span class="mr-4">
            {{ 'Copyright © ' . Carbon\Carbon::now()->year . " cubaescucha.com" }}
        </span>
        <div class="uppercase bg-blueGray-200 inline-block rounded">
            @foreach(config('app.languages') as $langLocale => $langName)
                <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="px-2 rounded @if (app()->getLocale() == $langLocale) bg-emerald-300 @endif">{{ $langLocale }}</a>
            @endforeach
        </div>
    </div>

    <div class="w-full sm:w-1/2 text-sm font-light text-left sm:text-right py-3">
        <a href="" class="mx-2">{{ __('Help') }}</a>
        <a href="" class="mx-2">{{ __('Privacy') }}</a>
        <a href="" class="mx-2">{{ __('Terms') }}</a>
        <a href="https://www.paypal.com/donate?business=XV9WBWPSYN7WG&item_name=Your+donation+will+be+purposed+to+develop+and+maintain+cubaescucha.com.&currency_code=USD" target="__blank" class="ml-2 px-2 bg-amber-400 rounded">{{ __('Donate') }}</a>
    </div>

</div>
