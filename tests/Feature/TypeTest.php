<?php

namespace Tests\Feature;

use App\Type;
use App\User;
use Tests\TestCase;

class TypeTest extends TestCase
{
    /** @var \App\User */
    protected $user;

    /** @var \App\type */
    protected $type;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->type = factory(Type::class)->create();
    }

    /** @test */
    public function search_type()
    {
        $this->actingAs($this->user)
            ->getJson('/api/settings/types/search?q=type_name')
            ->assertSuccessful();
    }

    /** @test */
    public function get_types()
    {
        $this->actingAs($this->user)
            ->getJson('/api/settings/types')
            ->assertSuccessful();
    }

    /** @test */
    public function get_type()
    {
        $this->actingAs($this->user)
            ->getJson('/api/settings/types/' . $this->type->id)
            ->assertSuccessful();
    }

    /** @test */
    public function create_type()
    {
        $this->actingAs($this->user)
            ->postJson('/api/settings/types', [
                'name' => 'type_name',
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('types', [
            'name' => 'type_name',
        ]);
    }

    /** @test */
    public function edit_type()
    {
        $this->actingAs($this->user)
            ->getJson('/api/settings/types/' . $this->type->id . '/edit')
            ->assertSuccessful();
    }

    /** @test */
    public function update_type()
    {
        $this->actingAs($this->user)
            ->patchJson('/api/settings/types/' . $this->type->id, [
                'name' => 'updated_type_name',
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('types', [
            'name' => 'updated_type_name',
        ]);
    }

    /** @test */
    public function delete_type()
    {
        $this->actingAs($this->user)
            ->deleteJson('/api/settings/types/' . $this->type->id)
            ->assertSuccessful();

        $this->assertDatabaseMissing('types', [
            'id' => $this->type->id
        ]);
    }
}