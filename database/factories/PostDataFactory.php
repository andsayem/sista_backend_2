<?php

namespace Database\Factories;

use App\Models\PostData;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'post_type' => $this->faker->randomDigitNotNull,
        'caption' => $this->faker->text,
        'cat_id' => $this->faker->randomDigitNotNull,
        'background_id' => $this->faker->randomDigitNotNull,
        'font_style' => $this->faker->word,
        'font_size' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
