<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Default categories;
     *
     * @var array
     */
    protected $categories = [
        [
            'name' => 'Car',
            'icon' => 'fa-car',
        ],
        [
            'name' => 'Motorcycle',
            'icon' => 'fa-motorcycle',
        ],
        [
            'name' => 'Property to rent',
            'icon' => 'fa-building',
        ],
        [
            'name' => 'Electronics',
            'icon' => 'fa-television',
        ],
        [
            'name' => 'To your home',
            'icon' => 'fa-television',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            Category::create($category);
        }
    }
}
