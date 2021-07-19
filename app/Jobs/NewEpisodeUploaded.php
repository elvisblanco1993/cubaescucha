<?php

namespace App\Jobs;

use App\Mail\NotifyNewEpisodeUploaded;
use App\Models\Podcast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewEpisodeUploaded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $podcast;
    public $episode_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Podcast $podcast, $episode_name)
    {
        $this->podcast = $podcast;
        $this->episode_name = $episode_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Start sending notifications for subscribers of " . $this->podcast->name);

        $followers = $this->podcast->followers;

        foreach ($followers as $follower) {
            Mail::to($follower->email)->send(new NotifyNewEpisodeUploaded($this->podcast->name,$this->podcast->url,$this->episode_name));
        }
    }
}
