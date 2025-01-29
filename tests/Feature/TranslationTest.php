<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Translation;

class TranslationTest extends TestCase {
    public function test_create_translation() {
        $response = $this->postJson('/api/translations', [
            'locale' => 'en',
            'key' => 'welcome',
            'content' => 'Welcome',
            'tags' => ['web']
        ]);

        $response->assertStatus(201);
    }
}