<?php

namespace Tests\Feature\Order;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Product\Product;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Http;
use App\DTO\PaymentData;



class OrderApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_example(): void
    {

       // $user = User::find(2)->first();
       
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $productFirst = Product::factory()->create([ 
            'price' => '100.50',
            'stock' => 100,
        ]);

        $productSecond = Product::factory()->create([
            'price' => '200.50',
            'stock' => 100,
        ]);

        //$product_first = Product::find(2)->first();

        //$product_second = Product::find(3)->first();

        
        $response = $this->postJson('/api/order', [
            "payment_method"=>"cod",
            "grand_total" => '100.50',
            "items"=>[
                [
                    "product_id"=>$productFirst->id,
                    "quantity"=>1
                ],
                [
                    "product_id"=>$productSecond->id,
                    "quantity"=>1
                ]
            ]
        ]);

        //$response = $this->get('/');

        $response->assertStatus(201)->assertJson([
                "success"=>true
            ]);
    }
}

