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
            'name' => 'Cars',
            'icon' => 'fa-car',
            'fields' => [
                [
                    'name' => 'Mileage in kilometers',
                    'type' => 'range',
                ],
                [
                    'name' => 'Year',
                    'type' => 'range',
                ],
                [
                    'name' => 'Fuel',
                    'type' => 'check_box',
                    'options' => [
                        'Gasoline', 'Alcohol', 'Diesel', 'Natural Gas',
                    ],
                ],
            ],
        ],
        [
            'name' => 'Motorcycles',
            'icon' => 'fa-motorcycle',
        ],
        [
            'name' => 'Properties to rent',
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
        foreach ($this->categories as $options) {
            $category = Category::create(array_except($options, 'fields'));

            if (isset($options['fields'])) {
                $category->fields()->createMany($options['fields']);
            }
        }
    }
}
