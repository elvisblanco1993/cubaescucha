@extends('layouts.web')
@section('content')

    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        {{-- Podcasts --}}
        <div class="grid grid-cols-4 gap-8">

            @forelse ($podcastsList as $podcast)

            <a href="{{ route('podcast.display', ['podcast' => $podcast->slug]) }}" class="col-span-4 sm:col-span-2 xl:col-span-1 bg-gray-50 rounded-lg shadow hover:shadow-lg hover:text-blue-600">

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

    </div>

@endsection
