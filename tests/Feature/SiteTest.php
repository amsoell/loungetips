<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteTest extends TestCase
{
    use DatabaseMigrations;

    public function testFrontPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Got a tip? Share it!');
    }

    public function testForum()
    {
        $response = $this->get('/talk');

        $response->assertStatus(200);
        $response->assertSee('Index');
    }
}
