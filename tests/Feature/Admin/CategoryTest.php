<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    //---Category Listing---

    /** @test */
    public function it_shows_the_categories_list()
    {
        Category::factory()->create([
            'name'=>'Camisetas',
        ]);
        Category::factory()->create([
            'name'=>'Pantalones',
        ]);
        $this->get(route('categories.index'))
            ->assertStatus(200)
            ->assertSee('Camisetas')
            ->assertSee('Pantalones');
    }
    /** @test */
    function it_shows_a_default_message_if_the_categories_list_is_empty()
    {
        $this->get(route('categories.index'))
            ->assertStatus(200)
            ->assertSee('No hay categorías registradas.');
    }

    //---Create Category---

    /** @test */
    function it_loads_the_new_categories_page()
    {
        $this->get(route('categories.create'))
            ->assertStatus(200)
            ->assertSee('Registrar Categoría');
    }

//    /** @test */
//    function it_creates_a_new_category()
//    {
//        $category=Category::factory()->create();
//
//        $this->post(route('categorys.store'), [
//            'name'=>'Pantalones',
//            'image'=>'pantalones.png',
//        ])->assertStatus(200)
//            ->assertRedirect(route('categories.index'));
//    }

    //---Update Category---

    /** @test */
    function it_loads_the_edit_category_page()
    {
        $category = Category::factory()->create();

        $this->get(route('categories.edit',$category))
        ->assertStatus(200)
            ->assertViewIs('admin.category.edit')
            ->assertSee('Editar Categoría')
            ->assertViewHas('category', function ($viewCategory) use ($category) {
                return $viewCategory->id === $category->id;
            });
    }

//    /** @test */
//    function it_updates_a_category()
//    {
//        $category = category::factory()->create();
//
//        $this->put(route('categories.update',$category), [
//            'name' => 'Medias',
//            'image' => 'medias.png',
//        ])->assertStatus(200)
//            ->assertRedirect(route('categories.index'));
//
//        $this->assertDatabaseHas('categorys',[
//            'name' => 'Medias',
//            'code' => 'P-01',
//            'description' => 'Lorem ipsum dolor',
//            'price' => 10,
//            'category_id' => $newCategory->id,
//        ]);
//
//        $this->assertDatabaseMissing('color_category',[
//            'category_id'=>$category->id,
//            'color_id'=>$oldColor1->id,
//        ]);
//    }
}
