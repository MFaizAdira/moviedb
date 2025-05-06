<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function definition(): array
{
    $title = fake()->sentence(rand(3, 6));
    $slug = Str::slug($title);
    return [
        'title' => $title,
        'slug' => $slug,
        'synopsis' => fake()->paragraph(rand(5, 10)),
        'category_id' => Category::inRandomOrder()->first(),
        'year' => fake()->year(),
        'actors' => fake()->name() . ', ' . fake('id')->name(),
        'cover_image' => 'https://picsum.photos/seed/' . Str::random(10) . '/480/640',
        'created_at' => now(),
        'updated_at' => now(),
    ];
}
}
