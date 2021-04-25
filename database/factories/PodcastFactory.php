<?php

namespace Database\Factories;

use App\Models\Podcast;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PodcastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Podcast::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
            'description' => $this->faker->text(150),
            'tags' => $this->faker->text(20),
            'lang' => 'es',
            'style' => 'episodic',
            'explicit' => true,
            'thumbnail' => 'podcasts/covers/ukCiJrewnApiiLt5jyHeo52NDVuuUF80j8BYscEh.jpg',
        ];
    }
}
