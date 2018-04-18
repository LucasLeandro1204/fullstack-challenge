<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdvertisementControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_list_advertisements(): void
    {
        factory(Advertisement::class, 20)->create();

        $response = $this->json('GET', route('advertisement.index'));
        $response->assertStatus(200);

        $this->assertCount(15, $response->original);
    }

    /**
     * @test
     */
    public function can_filter_advertisements_by_id(): void
    {
        [$first, $last] = factory(Advertisement::class, 2)->create();

        $response = $this->json('GET', route('advertisement.index'));

        $this->assertEquals($last->id, $response->original[0]->id);

        $response = $this->json('GET', route('advertisement.index', [
            'order_by' => 'asc',
        ]));

        $this->assertEquals($first->id, $response->original[0]->id);
    }

    /**
     * @test
     */
    public function can_filter_advertisements_by_title(): void
    {
        factory(Advertisement::class, 2)->create();
        factory(Advertisement::class)->create([
            'title' => 'Some random title',
        ]);

        $response = $this->json('GET', route('advertisement.index', [
            'search' => 'random ti',
        ]));

        $this->assertCount(1, $response->original);
        $this->assertEquals('Some random title', $response->original[0]->title);
    }

    /**
     * @test@
     */
    public function can_get_an_advertisement(): void
    {
        $advertisement = factory(Advertisement::class)->create();

        $response = $this->json('GET', route('advertisement.show', $advertisement));
        $response->assertStatus(200);

        $this->assertEquals($advertisement->id, $response->original->id);
    }
}
