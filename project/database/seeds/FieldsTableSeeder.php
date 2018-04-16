<?php

use App\Field;
use App\Category;
use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Default fields.
     *
     * @var array
     */
    protected $fields = [
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
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $category = Category::where('name', 'Car')->firstOrFail();

            $category->fields()->createMany($this->fields);
        } catch (\Exception $e) {
            dump('Car category not found, run categories seed first =)');
        }
    }
}
