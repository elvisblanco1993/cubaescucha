@php
   echo "<?xml version='1.0' encoding='UTF-8'?>" . PHP_EOL;
@endphp
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <channel>
        <title>{{ $podcast->name }}</title>
        <link>{{ config('app.url') . "/shows/" . $podcast->url }}</link>
        <description>{{ $podcast->description }}</description>
        <language>{{ $podcast->lang }}</language>
        <itunes:author>{{ $podcast->team->name }}</itunes:author>
        <itunes:owner>
            <itunes:name>{{ $podcast->team->name }}</itunes:name>
            <itunes:email>{{ $podcast->team->owner->email }}</itunes:email>
        </itunes:owner>
        <itunes:category text="{{ $podcast->tags }}" />
        @if ($podcast->style == 'e' || $podcast->style == 'ews')
            <itunes:type>episodic</itunes:type>
        @else
            <itunes:type>serial</itunes:type>
        @endif
        <image>
            <link>{{$podcast->link}}</link>
            <title>{{$podcast->name}}</title>
            <url>{{ asset('covers/' . $podcast->thumbnail) }}</url>
        </image>
        <itunes:image href="{{ asset('covers/' . $podcast->thumbnail) }}" />
        <itunes:explicit>{{ $podcast->explicit }}</itunes:explicit>
        @forelse ($podcast->episodes as $episode)
        <item>
            <guid>{{ $episode->uuid }}</guid>
            <title>{{ $episode->title }}</title>
            <itunes:summary>
                {{ $episode->show_notes }}
            </itunes:summary>
            <description>{{ $episode->show_notes }}</description>
            <pubDate>{{ date('r', strtotime($episode->created_at)) }}</pubDate>
            <itunes:episodeType>{{ $episode->type }}</itunes:episodeType>
            <itunes:episode>{{ $episode->episode_no }}</itunes:episode>
            @if ($podcast->style == 'ews')
            <itunes:season>{{ $episode->season }}</itunes:season>
            @endif
            <itunes:order>{{ $episode->episode_no }}</itunes:order>
            <itunes:duration>{{ $episode->audio_duration }}</itunes:duration>
            <enclosure length="{{ Storage::size('podcasts/episodes/' . $episode->file_name) }}" type="audio/mpeg" url="{{ route('play_episode', ['podcast' => $podcast->url, 'episode' => $episode->file_name]) }}"/>
        </item>
        @empty
        @endforelse
    </channel>
</rss>
