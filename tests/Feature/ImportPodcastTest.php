<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ImportPodcastTest extends TestCase
{
    public function test_import_remote_feed()
    {
        $feed_url = 'https://google.com'; // https...
        $podcast_url = Str::random(8);
        $owner = 1;
        $email = "test@cubaescucha.com"
        // Run Job Now (no wait)
    }
}
