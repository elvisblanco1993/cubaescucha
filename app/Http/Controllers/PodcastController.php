<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PodcastStatsExport;

class PodcastController extends Controller
{

    /**
     * Returns podcast main screen, displaying all episodes.
     */
    public function index()
    {
        return view('podcast.index', [
            'podcasts' => Podcast::where('user_id', auth()->user()->id)->paginate(5)
        ]);
    }

    /**
     * Returns a view where the new podcast will be created.
     */
    public function create()
    {
        return view('podcast.create');
    }

    /**
     * Returns a view with podcast details.
     */
    public function show(Podcast $podcast)
    {
        return view('podcast.show', [
            'podcast' => $podcast,
            'publisher' => User::findOrFail($podcast->user_id)->first(),
            'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
            'episodes' => $podcast->episodes()->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    /**
     * Returns similar data as the show() function, but instead faces the end-user.
     */
    public function display($podcast)
    {
        $podcast = Podcast::where('slug', $podcast)->first();

        return view('web.podcast', [
            'name' => $podcast->name,
            'description' => $podcast->description,
            'author' => User::findOrFail($podcast->user_id)->first()->name,
            'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
            'episodes' => $podcast->episodes()->orderBy('created_at', 'ASC')->get(),
            'rss' => $podcast->rss,
        ]);
    }

    /**
     * Returns a view where the podcast details can be edited.
     */
    public function edit(Podcast $podcast)
    {
        return view('podcast.edit', ['podcast' => $podcast]);
    }


    public function fileExport(Podcast $podcast)
    {
        return Excel::download(new PodcastStatsExport($podcast->id), 'podcast-statistics.xlsx');
    }

    /**
     * Generates the RSS feed for the podcast.
     * Runs every time a new episode is added to the podcast,
     * adding the episode information to it.
     */
    public static function updateRssFeed(Podcast $podcast)
    {
        $year = Carbon::now()->year;
        $author = $podcast->user->name;
        $author_email = User::findOrFail($podcast->user_id)->first()->email;
        $image = Storage::disk('s3')->url($podcast->thumbnail);
        $explicit = ($podcast->explicit == 0) ? 'false' : 'true';
        $rssFileName = Str::slug($podcast->name);

        $feed =
"<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0' xmlns:itunes='http://www.itunes.com/dtds/podcast-1.0.dtd' xmlns:content='http://purl.org/rss/1.0/modules/content/'>
    <channel>
        <title>$podcast->name</title>
        <link>https://www.apple.com/itunes/podcasts/</link>
        <language>en-us</language>
        <copyright>© $year</copyright>
        <itunes:author>$author</itunes:author>
        <description>$podcast->description</description>
        <itunes:type>$podcast->type</itunes:type>
        <itunes:owner>
            <itunes:name>$author</itunes:name>
            <itunes:email>$author_email</itunes:email>
        </itunes:owner>
        <itunes:image href='$image'/>
        <itunes:category text='$podcast->tags'/>
        <itunes:explicit>$explicit</itunes:explicit>";

    foreach ($podcast->episodes as $episode) {

        $uuid = $episode->uuid;
        $published_on = date('D, d M Y h:i:s ', strtotime($episode->created_at)) . config('app.timezone');
        $fileUrl = Storage::disk('s3')->url($episode->file_name);
        $fileSize = Storage::disk('s3')->size($episode->file_name);
        $episode_explicit = ($episode->explicit == 0) ? 'false' : 'true';
    $feed .= "
            <item>
                <itunes:episodeType>trailer</itunes:episodeType>
                <itunes:title>$episode->title</itunes:title>
                <description>
                    <content:encoded>
                        <![CDATA[$episode->show_notes]]>
                    </content:encoded>
                </description>
                <enclosure length='$fileSize' type='audio/mpeg' url='$fileUrl'/>
                <guid>$uuid</guid>
                <pubDate>$published_on</pubDate>
                <itunes:duration>1079</itunes:duration>
                <itunes:explicit>$episode_explicit</itunes:explicit>
            </item>";
    }

$feed .= "
    </channel>
</rss>";

        Storage::disk('rss')->delete($rssFileName.'.xml');
        Storage::disk('rss')->put($rssFileName.'.xml', $feed);
    }
}
