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
        factory(Advertisement::class, 30)->create();

        $response = $this->json('GET', route('advertisement.index'));
        $response->assertStatus(200);

        $this->assertCount(15, $response->original->data);
    }

    /**
     * @test
     */
    public function can_get_an_advertisement(): void
    {
        $advertisement = factory(Advertisement::class)->create();

        $response = $this->json('GET', route('advertisement.show', $advertisement));
        $response->assertStatus(200);

        $this->assertEquals($advertisement->id, $response->original->id);
    }
}
