<div class="bg-white text-bluegray-900 border-t">
    <div class="max-w-5xl mx-auto py-2 sm:flex items-center justify-between px-4 md:px-8 text-center">
        {{-- Left side --}}
        <div class="w-full sm:w-1/2 text-sm sm:text-left font-light py-3">
            <span class="mr-4">
                {{ 'Copyright © ' . Carbon\Carbon::now()->year . " voicebits.co" }}
            </span>
            <div class="uppercase bg-bluegray-400 rounded inline-flex items-center">
                @foreach(config('app.languages') as $langLocale => $langName)
                    <a
                        href="{{ url()->current() }}?change_language={{ $langLocale }}"
                        @class([
                            'text-xs',
                            'line-height-full',
                            'px-1',
                            'rounded',
                            'bg-emerald-400' => app()->getLocale() == $langLocale,
                            'text-bluegray-800' => app()->getLocale() == $langLocale
                        ])>{{ $langLocale }}</a>
                @endforeach
            </div>
        </div>

        <div class="w-full sm:w-1/2 text-sm font-light text-center sm:text-right py-3">
            <a href="{{ route('help') }}" class="mx-2">{{ __('Help') }}</a>
            <a href="{{ route('pricing') }}" class="mx-2">{{ __('Pricing') }}</a>
            <a href="{{ route('policy.show') }}" class="mx-2">{{ __('Privacy') }}</a>
            <a href="{{ route('terms.show') }}" class="mx-2">{{ __('Terms') }}</a>
        </div>
    </div>
</div>
