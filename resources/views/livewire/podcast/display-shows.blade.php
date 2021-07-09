<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">


        <nav x-data="init()" @keydown.window.prevent.ctrl.k="search()">

        <div class="my-6">
            <input type="search"
                placeholder="{{__('Search')}} ctrl+k"
                wire:model="query"
                accesskey="/"
                class="max-w-full mx-auto"
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

        <div class="grid grid-cols-4 gap-10">

            @forelse ($shows as $show)

                <a href="{{ route('podcast.display', ['podcast' => $show->url]) }}" class="col-span-2 md:col-span-1">
                    <div class="">
                        <img src="{{ Storage::disk('s3')->url($show->thumbnail) }}" alt="{{ $show->name }}" class="rounded-lg">
                        <div class="text-xs text-blueGray-800 py-2">
                            {{ $show->name }}
                        </div>
                        <div class="text-xs text-blueGray-600">
                            {{ $show->user->name }}
                        </div>
                    </div>
                </a>

            @empty
                <div class="col-span-4 w-full mx-auto prose text-center">
                    @if (empty($query))
                    <h4>
                        {{ __("Huh! Such empty :(") }}
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