<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Cleaning', 'description' => 'All cleaning services'],
            ['name' => 'Consultation', 'description' => 'Professional consultation services'],
            ['name' => 'Treatment', 'description' => 'Treatment services'],
            ['name' => 'Maintenance', 'description' => 'Regular maintenance services'],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create([
                'name' => $category['name'],
                'description' => $category['description'],
            ]);
        }

        $categories = ServiceCategory::all();

        foreach ($categories as $category) {
            Service::factory()
                ->count(5)
                ->for($category)
                ->create();
        }    }
}
