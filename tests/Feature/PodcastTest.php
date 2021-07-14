<?php

namespace Tests\Feature;

use App\Models\Podcast;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class PodcastTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_a_podcast()
    {
        $podcast = new Podcast([
            'user_id' => 1,
            'name' => 'Test Podcast',
            'slug' => 'test-podcast',
            'url' => Str::random(8),
            'description' => 'Lorem ipsum dolor',
            'tags' => 'tag1, tag2, tag3',
            'lang' => 'en',
            'style' => 'episodic',
            'explicit' => 'on',
            'thumbnail' => 'thumb.png',
            'is_public' => 'on',
            'website_style' => 'modern'
        ]);

        $response = $this->assertTrue($podcast->save());

    }
}
