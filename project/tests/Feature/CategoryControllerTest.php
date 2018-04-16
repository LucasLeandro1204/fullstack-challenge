<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_list_categories(): void
    {
        factory(Category::class, 10)->create();

        $response = $this->json('GET', route('category.index'));

        $this->assertCount(10, $response->original);
    }
}
