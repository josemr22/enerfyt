<?php

namespace Tests\Feature\Admin;

use App\Models\{Category, Product, Size, Color};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    //---Product Listing---

    /** @test */
    public function it_shows_the_products_list()
    {
        $category1=Category::factory()->create();
        $category2=Category::factory()->create();
        Product::factory()->create([
            'name'=>'Medias',
            'category_id'=>$category1->id,
        ]);
        Product::factory()->create([
            'name'=>'Camiseta',
            'category_id'=>$category2->id,
        ]);
        $this->get(route('products.index'))
            ->assertSee('Medias')
            ->assertSee('Camiseta')
            ->assertStatus(200);
    }
    /** @test */
    function it_shows_a_default_message_if_the_products_list_is_empty()
    {
        $this->get(route('products.index'))
            ->assertStatus(200)
            ->assertSee('No hay productos registrados.');
    }

    //---Product Listing---

    /** @test */
    function it_displays_the_products_details()
    {
        $category=Category::factory()->create();
        $product = Product::factory()->create([
            'name'=>'Medias',
            'price'=>10,
            'category_id'=>$category->id,
        ]);

        $this->get(route('products.show',$product))
            ->assertStatus(200)
            ->assertSee('Medias')
            ->assertSee('10.00');
    }
    /** @test */
    function it_displays_a_404_error_if_the_product_is_not_found()
    {
        $this->withExceptionHandling();

        $this->get(route('products.show',99))
            ->assertStatus(404);
    }

    //---Create Product---

    /** @test */
    function it_loads_the_new_products_page()
    {
        $this->get(route('products.create'))
            ->assertStatus(200)
            ->assertSee('Crear Producto');
    }

    /** @test */
    function it_creates_a_new_product()
    {
        $category=Category::factory()->create();

        $sizeA = Size::factory()->create();
        $sizeB = Size::factory()->create();
        $colorA = Color::factory()->create();
        $colorB = Color::factory()->create();
        $colorC = Color::factory()->create();

        $this->post(route('products.store'), $this->getValidData([
            'category_id'=>$category->id,
            'sizes' => [$sizeA->id,$sizeB->id],
            'colors' => [$colorA->id,$colorB->id],
        ]))->assertRedirect(route('products.index'));

        $product = Product::first();

        $this->assertDatabaseHas('color_product',[
            'color_id'=> $colorA->id,
            'product_id'=> $product->id,
        ]);

        $this->assertDatabaseHas('product_size',[
            'product_id'=> $product->id,
            'size_id'=> $sizeA->id,
        ]);

        $this->assertDatabaseMissing('color_product',[
            'product_id'=> $product->id,
            'color_id'=> $colorC->id,
        ]);
    }

    //---Update Product---

    /** @test */
    function it_loads_the_edit_product_page()
    {
        $category=Category::factory()->create();
        $product = Product::factory()->create([
            'category_id'=>$category->id,
        ]);

        $this->get(route('products.edit',$product)) // usuarios/5/editar
        ->assertStatus(200)
            ->assertViewIs('admin.product.edit')
            ->assertSee('Editar Producto')
            ->assertViewHas('product', function ($viewProduct) use ($product) {
                return $viewProduct->id === $product->id;
            });
    }

    /** @test */
    function it_updates_a_product()
    {
        $oldCategory=Category::factory()->create();
        $product = Product::factory()->create([
            'category_id'=>$oldCategory->id,
        ]);
        $oldColor1=Color::factory()->create();
        $oldColor2=Color::factory()->create();
        $oldSize1=Size::factory()->create();
        $oldSize2=Size::factory()->create();
        $product->colors()->attach([$oldColor1->id, $oldColor2->id]);
        $product->sizes()->attach([$oldSize1->id, $oldSize2->id]);
        $newCategory = Category::factory()->create();
        $newColor1= Color::factory()->create();
        $newColor2= Color::factory()->create();
        $newSize1= Size::factory()->create();
        $newSize2= Size::factory()->create();

        $this->put(route('products.update',$product), [
            'name' => 'Medias',
            'code' => 'P-01',
            'description' => 'Lorem ipsum dolor',
            'price' => 10,
            'category_id' => $newCategory->id,
            'colors'=>[$newColor1->id,$newColor2->id],
            'sizes'=>[$newSize1->id,$newSize2->id],
        ])->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products',[
            'name' => 'Medias',
            'code' => 'P-01',
            'description' => 'Lorem ipsum dolor',
            'price' => 10,
            'category_id' => $newCategory->id,
        ]);

        $this->assertDatabaseHas('color_product',[
            'product_id'=>$product->id,
            'color_id'=>$newColor1->id,
        ]);

        $this->assertDatabaseHas('color_product',[
            'product_id'=>$product->id,
            'color_id'=>$newColor2->id,
        ]);

        $this->assertDatabaseMissing('color_product',[
            'product_id'=>$product->id,
            'color_id'=>$oldColor1->id,
        ]);

        $this->assertDatabaseMissing('color_product',[
            'product_id'=>$product->id,
            'color_id'=>$oldColor2->id,
        ]);

        $this->assertDatabaseHas('product_size',[
            'product_id'=>$product->id,
            'size_id'=>$newSize1->id,
        ]);

        $this->assertDatabaseHas('product_size',[
            'product_id'=>$product->id,
            'size_id'=>$newSize2->id,
        ]);

        $this->assertDatabaseMissing('product_size',[
            'product_id'=>$product->id,
            'size_id'=>$oldSize1->id,
        ]);

        $this->assertDatabaseMissing('product_size',[
            'product_id'=>$product->id,
            'size_id'=>$oldSize2->id,
        ]);
    }

    protected function getValidData(array $custom =[]){
        return array_filter(array_merge($this->defaultData,$custom));
    }

    protected $defaultData=[
        'name' => 'Medias',
        'code' => 'P-01',
        'description' => 'Lorem ipsum dolor',
        'price' => 10,
        'category_id' => 1,
    ];
}
