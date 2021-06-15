@php
   echo "<?xml version='1.0' encoding='UTF-8'?>" . PHP_EOL
@endphp

<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <channel>
        <title>{{ $podcast->name }}</title>
        <link>{{ config('app.url') . "/podcast/" . $podcast->url . '/rss' }}</link>
        <description>{{ $podcast->description }}</description>
        <language>{{ $podcast->lang }}</language>
        <itunes:author>{{ $podcast->user->name }}</itunes:author>
        <itunes:category text="{{ $podcast->tags }}" />
        @if ($podcast->style == 'e' || $podcast->style == 'ews')
            <itunes:type>episodic</itunes:type>
        @else
            <itunes:type>serial</itunes:type>
        @endif
        <itunes:image href="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" />
        @forelse ($podcast->episodes as $episode)
        <item>
            <guid>{{ $episode->uuid }}</guid>
            <title>{{ $episode->title }}</title>
            <description>{{ $episode->show_notes }}</description>
            <pubDate>{{ date('r', strtotime($episode->created_at)) }}</pubDate>
            <itunes:episodeType>{{ $episode->type }}</itunes:episodeType>
            <itunes:episode>{{ $episode->episode_no }}</itunes:episode>
            @if ($podcast->style == 'ews')
            <itunes:season>{{ $episode->season }}</itunes:season>
            @endif
            <itunes:order>{{ $episode->episode_no }}</itunes:order>
            <itunes:duration>{{ $episode->audio_duration }}</itunes:duration>
            <enclosure length="{{ Storage::disk('s3')->size($episode->file_name) }}" type="audio/mpeg" url="{{ Storage::disk('s3')->url($episode->file_name) }}"/>

        </item>
        @empty

        @endforelse
    </channel>
</rss>
