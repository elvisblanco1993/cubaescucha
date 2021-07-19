<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyNewEpisodeUploaded extends Mailable
{
    use Queueable, SerializesModels;

    public $podcast_name;
    public $podcast_url;
    public $episode_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($podcast_name, $podcast_url, $episode_name)
    {
        $this->podcast_name = $podcast_name;
        $this->podcast_url = $podcast_url;
        $this->episode_name = $episode_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info("Message");
        return $this->subject("New episode alert from " . $this->podcast_name)->markdown('mail.notify-new-episode-uploaded');
    }
}
