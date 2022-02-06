<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    //-- Order Listing---

    /** @test */
    public function it_shows_the_orders_list()
    {
        Order::factory()->create([
            'name'=>'Jose',
        ]);
        Order::factory()->create([
            'name'=>'Luis',
        ]);
        $this->get(route('orders.index'))
            ->assertSee('Jose')
            ->assertSee('Luis')
            ->assertStatus(200);
    }
    /** @test */
    function it_shows_a_default_message_if_the_Orders_list_is_empty()
    {
        $this->get(route('orders.index'))
            ->assertStatus(200)
            ->assertSee('Ningún pedido encontrado');
    }

    //---Create Order---

//    /** @test */
//    function it_loads_the_new_Orders_page()
//    {
//        $this->get(route('Orders.create'))
//            ->assertStatus(200)
//            ->assertSee('Registrar Order');
//    }
//
//    /** @test */
//    function it_creates_a_new_Order()
//    {
//        $this->post(route('Orders.store'), [
//            'name'=>'Blanco',
//            'code'=>'#FFFFFF',
//        ])->assertRedirect(route('Orders.index'));
//
//        $this->assertDatabaseHas('Orders',[
//            'name'=>'Blanco',
//            'code'=>'#FFFFFF',
//        ]);
//    }
//
//    //---Update Order---
//
//    /** @test */
//    function it_loads_the_edit_Order_page()
//    {
//        $Order = Order::factory()->create();
//
//        $this->get(route('Orders.edit',$Order))
//            ->assertStatus(200)
//            ->assertViewIs('admin.Order.edit')
//            ->assertSee('Editar Order')
//            ->assertViewHas('Order', function ($viewOrder) use ($Order) {
//                return $viewOrder->id === $Order->id;
//            });
//    }
//
//    /** @test */
//    function it_updates_a_Order()
//    {
//        $Order = Order::factory()->create([
//            'name'=>'Blanco',
//            'code'=>'#FFFFFF',
//        ]);
//
//        $this->put(route('Orders.update',$Order), [
//            'name' => 'Negro',
//            'code' => '#000000',
//        ])->assertRedirect(route('Orders.index'));
//
//        $this->assertDatabaseHas('Orders',[
//            'name' => 'Negro',
//            'code' => '#000000',
//        ]);
//
//        $this->assertDatabaseMissing('Orders',[
//            'name'=>'Blanco',
//            'code'=>'#FFFFFF',
//        ]);
//    }
}
