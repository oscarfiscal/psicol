<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketControllerTest extends TestCase
{
    use refreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
  //test crear boleto 
    public function test_ticket_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/api/boleto',[
            'code'=>'12345',
            'location'=>'sur',
            'price'=>'100',
        ]); // aqui se crea el boleto

        $this->assertCount(1,Ticket::all());    //se verifica que se haya creado un boleto

        $ticket = Ticket::first(); //se crea una variable para el boleto

        $this->assertEquals('12345',$ticket->code); //se verifica que el codigo del boleto sea 12345
        $this->assertEquals('sur',$ticket->location); //se verifica que la ubicacion sea sur
        $this->assertEquals('100',$ticket->price); //se verifica que

        $response->assertStatus(201); //se verifica que el status sea 201

        $response ->assertJson([
            'data'=> [
                'type'=>'boleto',
                'boleto_id'=>$ticket->id,
                'attributes'=>[
                    'code'=>$ticket->code,
                    'price'=>$ticket->price,
                    'location'=>$ticket->location,
                ]
            ]
        ]); //se verifica que el json sea el correcto

        //se verifica que el boleto se haya guardado en la base de datos
        $this->assertDatabaseHas ('tickets',[
            'code'=>'12345',
            'location'=>'sur',
            'price'=>'100',
      
          ]);
    }
}
