<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use JacobHyde\Tickets\App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $data = [
            'General',
        ];
        foreach ($data as $value) {
            Category::updateOrCreate(['name' => $value], ['name' => $value]);
        }
    }
}
