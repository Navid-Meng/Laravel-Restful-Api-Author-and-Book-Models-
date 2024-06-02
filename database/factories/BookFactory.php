<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = ['Fiction', 'Science Fiction', 'Fantasy', 'Mystery', 'Thriller', 'Horror', 'Romance', 'Historical Fiction', 'Young Adult', 'Non-fiction', 'Biography', 'Memoir'];
        return [
            'title' => substr($this->faker->realText($maxNbChars = 50), 0, 30),
            'publication_date' => $this->faker->date(),
            'author_id' => Author::factory(),
            'genre' => $this->faker->randomElement($genres),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'summary' => $this->faker->realText($maxNbChars = 200)
        ];
    }
}
