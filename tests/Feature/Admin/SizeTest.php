<?php

namespace Tests\Feature\Admin;

use App\Models\Size;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SizeTest extends TestCase
{
    use RefreshDatabase;

    //---Size Listing---

    /** @test */
    public function it_shows_the_sizes_list()
    {
        Size::factory()->create([
            'name'=>'L',
        ]);
        Size::factory()->create([
            'name'=>'XL',
        ]);
        $this->get(route('sizes.index'))
            ->assertStatus(200)
            ->assertSee('L')
            ->assertSee('XL');
    }
    /** @test */
    function it_shows_a_default_message_if_the_sizes_list_is_empty()
    {
        $this->get(route('sizes.index'))
            ->assertStatus(200)
            ->assertSee('No hay Tallas registradas.');
    }

    //---Create Size---

    /** @test */
    function it_loads_the_new_sizes_page()
    {
        $this->get(route('sizes.create'))
            ->assertStatus(200)
            ->assertSee('Registrar Talla');
    }

    /** @test */
    function it_creates_a_new_size()
    {
        $this->post(route('sizes.store'), [
            'name'=>'L',
        ])->assertRedirect(route('sizes.index'));

        $this->assertDatabaseHas('sizes',[
            'name'=> 'L',
        ]);
    }

    //---Update Size---

    /** @test */
    function it_loads_the_edit_size_page()
    {
        $size = Size::factory()->create();

        $this->get(route('sizes.edit',$size))
            ->assertStatus(200)
            ->assertViewIs('admin.size.edit')
            ->assertSee('Editar Talla')
            ->assertViewHas('size', function ($viewSize) use ($size) {
                return $viewSize->id === $size->id;
            });
    }

    /** @test */
    function it_updates_a_size()
    {
        $size = Size::factory()->create([
            'name'=>'L',
        ]);

        $this->put(route('sizes.update',$size), [
            'name' => 'XL',
        ])->assertRedirect(route('sizes.index'));

        $this->assertDatabaseHas('sizes',[
            'name' => 'XL',
        ]);

        $this->assertDatabaseMissing('sizes',[
            'name' => 'L',
        ]);
    }
}
