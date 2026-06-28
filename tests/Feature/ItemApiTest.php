<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItemApiTest extends TestCase
{
    /**
     * Test mengambil semua item.
     */
    public function test_get_all_items()
    {
        $response = $this->getJson('/api/v1/items');

        $response->assertStatus(401);
    }

    /**
     * Test mengambil item berdasarkan id yang tidak ada.
     */
    public function test_get_item_not_found()
    {
        $response = $this->getJson('/api/v1/items/999');

        $response->assertStatus(401);
    }

    /**
     * Test create item tanpa login.
     */
    public function test_create_item_without_login()
    {
        $response = $this->postJson('/api/v1/items', []);

        $response->assertStatus(401);
    }

    /**
     * Test update item tanpa login.
     */
    public function test_update_item_without_login()
    {
        $response = $this->putJson('/api/v1/items/1', []);

        $response->assertStatus(401);
    }
}