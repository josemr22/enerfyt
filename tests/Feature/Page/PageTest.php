<?php

namespace Tests\Feature\Page;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Product,Category,Size,Color};

class PageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->get('/')
            ->assertStatus(200);
    }
    /** @test */
    public function test_about()
    {
        $this->get('/nosotros')
            ->assertStatus(200);
    }
    /** @test */
    public function test_contact()
    {
        $this->get('/contacto')
            ->assertStatus(200);
    }
    /** @test */
    public function test_catalog()
    {
        $category1=Category::factory()->create();
        $category2=Category::factory()->create();
        $product1 = Product::factory()->create([
            'category_id'=>$category1->id,
        ]);
        $product2 = Product::factory()->create([
            'category_id'=>$category2->id,
        ]);
        $this->get("/catalogo/".$product1->category->id)
            ->assertStatus(200)
            ->assertSee($product1->name)
            ->assertDontSee($product2->name);
    }
    /** @test */
    public function detail_product()
    {
        $category1=Category::factory()->create();
        $category2=Category::factory()->create();
        $product1 = Product::factory()->create([
            'id'=>1,
            'category_id'=>$category1->id,
        ]);
        $product2 = Product::factory()->create([
            'id'=>2,
            'category_id'=>$category2->id,
        ]);
        $this->get('/detalle/1')
            ->assertStatus(200)
            ->assertViewIs('page.product-detail')
            ->assertSee($product1->name)
            ->assertDontSee($product2->name)
            ->assertViewHas('product', function ($viewProduct) use ($product1) {
                return $viewProduct->id === $product1->id;
            });
    }
    /** @test */
    public function add_item_to_cart()
    {
        $product = Product::factory()->create([
            'category_id'=>Category::factory()->create()->id,
        ]);
        $size = Size::factory()->create();
        $color = Color::factory()->create();
        $this->post('/cart',['productId'=>$product->id,'size'=>$size->id,'color'=>$color->id,'quantity'=>2])
            ->assertStatus(200);
    }
    /** @test */
    public function query_cart()
    {
        $this->get('/cart/query')
            ->assertStatus(200);
    }
//    /** @test */
//    public function delete_item_cart()
//    {
//        $this->delete('/cart',['rowId'=>$rowId])
//            ->assertStatus(200);
//    }
}
