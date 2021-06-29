<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="text-4xl font-bold text-center mt-12">
            {{ __("Shows") }}
        </div>

        <div class="my-6">
            <input type="search"
                placeholder="Search"
                wire:model="query"
                accesskey="/"
                class="w-full"
            >
        </div>

        <div class="grid grid-cols-4 gap-10">

            @forelse ($shows as $show)
                <a href="{{ route('podcast.display', ['podcast' => $show->url]) }}" class="hover:text-yellow-500 col-span-4 sm:col-span-2 lg:col-span-1">
                    <div class="">
                        <img src="{{ Storage::disk('s3')->url($show->thumbnail) }}" alt="">
                        <div class="text-inherit text-base font-semibold px-3 py-2">
                            {{ $show->name }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-4 w-full mx-auto prose text-center">
                    @if (empty($query))
                    <h4>
                        {{ __("Huh! such lonely.") }}
                    </h4>
                    @else
                    <h4>
                        {{ __("Sorry! we cannot find what you are looking for. Please check for typos and try again.") }}
                    </h4>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</div>
