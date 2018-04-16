<?php

namespace Tests\Feature;

use Tests\TestCase;

class SiteControllerTest extends TestCase
{
    /**
     * @test
     */
    public function can_enter_website(): void
    {
        $this
            ->getRoute('/')
            ->getRoute('/foo/bar/baz');
    }

    protected function getRoute(): self
    {
        $response = $this->get("/foo/bar/baz");

        $response->assertStatus(200);

        $this->assertInstanceof(View::class, $response->original);

        return $this;
    }
}
