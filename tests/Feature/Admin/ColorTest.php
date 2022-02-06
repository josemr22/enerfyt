<?php

namespace Tests\Feature\Admin;

use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    //-- Color Listing---

    /** @test */
    public function it_shows_the_colors_list()
    {
        Color::factory()->create([
            'name'=>'Blanco',
        ]);
        Color::factory()->create([
            'name'=>'Negro',
        ]);
        $this->get(route('colors.index'))
            ->assertSee('Blanco')
            ->assertSee('Negro')
            ->assertStatus(200);
    }
    /** @test */
    function it_shows_a_default_message_if_the_colors_list_is_empty()
    {
        $this->get(route('colors.index'))
            ->assertStatus(200)
            ->assertSee('No hay colores registrados.');
    }

    //---Create Color---

    /** @test */
    function it_loads_the_new_colors_page()
    {
        $this->get(route('colors.create'))
            ->assertStatus(200)
            ->assertSee('Registrar Color');
    }

    /** @test */
    function it_creates_a_new_color()
    {
        $this->post(route('colors.store'), [
            'name'=>'Blanco',
            'code'=>'#FFFFFF',
        ])->assertRedirect(route('colors.index'));

        $this->assertDatabaseHas('colors',[
            'name'=>'Blanco',
            'code'=>'#FFFFFF',
        ]);
    }

    //---Update Color---

    /** @test */
    function it_loads_the_edit_color_page()
    {
        $color = Color::factory()->create();

        $this->get(route('colors.edit',$color))
            ->assertStatus(200)
            ->assertViewIs('admin.color.edit')
            ->assertSee('Editar Color')
            ->assertViewHas('color', function ($viewColor) use ($color) {
                return $viewColor->id === $color->id;
            });
    }

    /** @test */
    function it_updates_a_color()
    {
        $color = Color::factory()->create([
            'name'=>'Blanco',
            'code'=>'#FFFFFF',
        ]);

        $this->put(route('colors.update',$color), [
            'name' => 'Negro',
            'code' => '#000000',
        ])->assertRedirect(route('colors.index'));

        $this->assertDatabaseHas('colors',[
            'name' => 'Negro',
            'code' => '#000000',
        ]);

        $this->assertDatabaseMissing('colors',[
            'name'=>'Blanco',
            'code'=>'#FFFFFF',
        ]);
    }
}
