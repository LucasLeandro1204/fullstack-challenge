<?php

use App\Field;
use App\Category;
use App\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::get();

        $categories->each(function (Category $category) {
            $advertisements = factory(Advertisement::class, rand(2, 21))->create([
                'category_id' => $category->id,
            ]);

            $advertisements->each(function (Advertisement $advertisement) use ($category) {
                $fields = $category->fields->map(function (Field $field) {
                    return [
                        'field_id' => $field->id,
                        'value' => $field->type == 'range'
                            ? rand(1000, 10000)
                            : $field->options[rand(0, count($field->options) - 1)],
                    ];
                });

                $advertisement->values()->createMany($fields->toArray());
            });
        });
    }
}
