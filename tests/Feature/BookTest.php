<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index_show_all(): void
    {
        // Könyvek létrehozása
        Book::factory()->count(3)->create();
        
        // API hívás
        $response = $this->getJson('/api/books');

        // Ellenőrzések
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}
