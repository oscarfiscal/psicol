<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Buyer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class buyerControllerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     
     //test  para crear comprador
    public function test_buyer_can_be_created()

    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/api/comprador',[
            'email' => 'oscarf@gmail.com',
            'password' => '123456', 
            'password_confirmation' => '123456',
            'name' => 'Oscar',
            'last_name' => 'Fiscal',
            'identification' => '123456789',
            'phone' => '123456789',        

           
        ]); // aqui se crea el comprador

        $this->assertCount(1,Buyer::all()); // aqui se verifica que se haya creado un comprador

        $buyer = Buyer::first(); // aqui se obtiene el comprador

        // aqui se verifica que los datos del comprador sean los mismos que se enviaron en el request
        $this->assertEquals('oscarf@gmail.com',$buyer->email);
        $this->assertEquals('123456',$buyer->password);     
        $this->assertEquals('123456',$buyer->password_confirmation);
        $this->assertEquals('Oscar',$buyer->name);
        $this->assertEquals('Fiscal',$buyer->last_name);
        $this->assertEquals('123456789',$buyer->identification);
        $this->assertEquals('123456789',$buyer->phone);

        $response->assertStatus(201);

        // aqui se verifica que el comprador se haya creado correctamente
        $response ->assertJson([
            'data'=>[
                'type'=>'comprador',
                'comprador_id'=>$buyer->id,
                'attributes'=>[
                    'email'=>$buyer->email,
                    'password'=>$buyer->password,
                    'password_confirmation'=>$buyer->password_confirmation,
                    'name'=>$buyer->name,
                    'last_name'=>$buyer->last_name,
                    'identification'=>$buyer->identification,
                    'phone'=>$buyer->phone,
                ]
            ]
        ]); 
       // se verifica que el comprador se haya guardado en la base de datos
        $this->assertDatabaseHas ('buyers',[
            'email' => 'oscarf@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => 'Oscar',
            'last_name' => 'Fiscal',
            'identification' => '123456789',
            'phone' => '123456789',
        ]);
    }

}