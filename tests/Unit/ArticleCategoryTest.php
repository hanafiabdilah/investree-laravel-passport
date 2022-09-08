<?php

namespace Tests\Unit;

use Tests\TestCase;

class ArticleCategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => "Bearer $this->token"
        ];

        $data = [
            'name' => 'Berita',
        ];

        // Tambah category artikel dengan token yang salah
        $this->post(route('article-category.store'), $data, ['Accept' => 'application/json'])->assertStatus(401)->assertJson([
            "message" => "Unauthenticated."
        ]);

        // Tambah category artikel dengan data yang benar
        $this->post(route('article-category.store'), $data, $headers)->assertStatus(201)->assertJson([
            'message' => 'article category created',
            'status' => 'success',
        ]);

        // Tambah category artikel dengan data yang salah
        $this->post(route('article-category.store'), [], $headers)->assertStatus(422)->assertJson([
            "message" => "The given data was invalid."
        ]);
    }
}
