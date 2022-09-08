<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ArticleTest extends TestCase
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

        $image = UploadedFile::fake()->image('tes.jpg');
        $data = [
            'title' => 'Tes',
            'content' => 'Content tes',
            'image' => $image,
            'category_id' => 21
        ];

        $dataUpdate = [
            'title' => 'Tes Update',
            'content' => 'Content Update',
            'category_id' => 21
        ];

        // Mengambil semua artiken dengan token yang salah
        $this->get(route('article.all'), ['Accept' => 'application/json'])->assertStatus(401)->assertJson([
            "message" => "Unauthenticated."
        ]);

        // Post artikel tanpa token
        $this->post(route('article.store'), $data, ['Accept' => 'application/json'])->assertStatus(401);

        // Get artikel by id dengan id yang benar tanpa token
        $this->get(route('article.detail', 15), ['Accept' => 'application/json'])->assertStatus(401);

        // Update artikel tanpa token
        $this->put(route('article.update', 15), $dataUpdate, ['Accept' => 'application/json'])->assertStatus(401);

        // Delete artiken tanpa token
        $this->delete(route('article.delete', 17), $data, ['Accept' => 'application/json'])->assertStatus(401);

        // Mengambil semua artiken dengan token yang benar
        $this->get(route('article.all'), $headers)->assertStatus(200);

        // Post artiken dengan data yang benar
        $this->post(route('article.store'), $data, $headers)->assertStatus(201);

        // Post artiken dengan data yang salah
        $this->post(route('article.store'), [], $headers)->assertStatus(422);

        // Get artikel by id dengan id yang salah
        $this->get(route('article.detail', 100), $headers)->assertStatus(404);

        // Get artikel by id dengan id yang benar
        $this->get(route('article.detail', 15), $headers)->assertStatus(200);

        // Update artikel dengan id yang salah
        $this->put(route('article.update', 255), $dataUpdate, $headers)->assertStatus(404);

        // Update artikel dengan id yang benar
        $this->put(route('article.update', 15), $dataUpdate, $headers)->assertStatus(200);

        // Delete artikel dengan id yang salah
        $this->delete(route('article.delete', 255), $data, $headers)->assertStatus(404);

        // Delete artikel dengan id yang benar
        $this->delete(route('article.delete', 29), $data, $headers)->assertStatus(200);
    }
}
