<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">


        <nav x-data="init()" @keydown.window.prevent.ctrl.k="search()">

        <div class="my-6">
            <input type="search"
                placeholder="{{__('Search')}} ctrl+k"
                wire:model="query"
                accesskey="/"
                class="max-w-full mx-auto rounded-xl"
                x-ref="k"
            >
        </div>

        <script>
            function init(){
                return {
                    search(){
                        setTimeout(() => {
                        this.$refs.k.focus()
                        }, 100)
                    }
                }
            }
        </script>

        @auth
            @if ($has_favorites && !$query)
            <div class="my-6">
                <div class="text-xl font-medium mb-4">
                    {{ __("Your subscriptions") }}
                </div>

                <div class="grid grid-cols-4 gap-10">
                    @forelse ($favorites as $favorite)
                        <a href="{{ route('podcast.display', ['podcast' => $favorite->url]) }}" class="col-span-2 md:col-span-1">
                            <div class="">
                                <img src="{{ Storage::disk('s3')->url($favorite->thumbnail) }}" alt="{{ $favorite->name }}" class="rounded-lg w-full h-48 object-cover">
                                <div class="text-xs text-blueGray-800 py-4">
                                    {{ $favorite->name }}
                                </div>
                                <div class="text-xs text-blueGray-600">
                                    {{ $favorite->team->name }}
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
            @endif
        @endauth


        <div class="my-6">
            <div class="text-xl font-medium mb-4">
                {{ __("Library") }}
            </div>

            <div class="grid grid-cols-4 gap-10">


                @forelse ($shows as $show)

                    <a href="{{ route('podcast.display', ['podcast' => $show->url]) }}" class="col-span-2 md:col-span-1">
                        <div class="">
                            <img src="{{ Storage::disk('s3')->url($show->thumbnail) }}" alt="{{ $show->name }}" class="rounded-lg w-full h-48 object-cover">
                            <div class="text-xs text-blueGray-800 py-4">
                                {{ $show->name }}
                            </div>
                            <div class="text-xs text-blueGray-600">
                                {{ $show->team->name }}
                            </div>
                        </div>
                    </a>

                @empty
                    <div class="col-span-4 w-full mx-auto text-center">
                        @if (empty($query))

                            <div class="text-2xl">{{__("Be the first of many. Inspire a revolution.")}}</div>

                            <img src="{{ asset('storage/undraw_podcast_q6p7.png') }}" alt="">

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
</div>
