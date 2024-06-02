<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()
            ->count(25)
            ->hasBooks(10)
            ->create();

        Author::factory()
            ->count(100)
            ->hasBooks(5)
            ->create();

        Author::factory()
            ->count(50)
            ->hasBooks(3)
            ->create();

        Author::factory()
            ->count(4)
            ->hasBooks(20)
            ->create();
    }
}
