<div class="sm:flex items-center justify-between mx-4 md:mx-8 text-blueGray-800">


    {{-- Left side --}}
    <div class="w-full sm:w-1/2 text-sm font-light">
        <span class="mr-4">
            {{ 'Copyright © ' . Carbon\Carbon::now()->year . " cubaescucha.com" }}
        </span>
        <div class="uppercase bg-blueGray-200 inline-block rounded">
            @foreach(config('app.languages') as $langLocale => $langName)
                <a href="{{ url()->current() }}?change_language={{ $langLocale }}" class="px-2 rounded @if (app()->getLocale() == $langLocale) bg-emerald-300 @endif">{{ $langLocale }}</a>
            @endforeach
        </div>
    </div>

    <div class="w-full sm:w-1/2 text-sm font-light text-left sm:text-right">
        <a href="" class="mr-2">About</a>
        <a href="" class="mx-2">Help</a>
        <a href="" class="mx-2">Terms</a>
        <a href="" class="ml-2">Donate</a>
    </div>
</div>
