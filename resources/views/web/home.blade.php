@extends('layouts.web')
@section('content')

    @include('web.about')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">

        {{-- Podcasts --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            @forelse ($podcastsList as $podcast)

            <a href="{{ route('podcast.display', ['podcast' => $podcast->slug]) }}" class="col-span-1 bg-gray-50 rounded-lg shadow hover:shadow-lg hover:text-blue-600">

                <div>
                    <img src="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" class="object-cover w-full h-48 rounded-t-lg">
                </div>
                <div class="p-4">
                    <div class="text-xl font-semibold">
                        {{ $podcast->name }}
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <div class="text-gray-600">
                            {{ __('By: ') . \App\Models\User::where('id', $podcast->user_id)->first()->name }}
                        </div>
                        <div class="text-gray-600">
                            {{ $podcast->episodes()->where('published_at', '<=', Carbon\Carbon::now())->count() . __(' episodes') }}
                        </div>
                    </div>
                </div>

            </a>

            @empty

            @endforelse

        </div>

        <div class="mt-8">
            {{ $podcastsList->links() }}
        </div>

    </div>

@endsection
