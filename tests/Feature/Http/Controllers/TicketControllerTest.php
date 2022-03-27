<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
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
            'user_id'=>User::factory()->create()->id,
            'event_id'=>Event::factory()->create()->id,
        ]); // aqui se crea el boleto

        $this->assertCount(1,Ticket::all());    //se verifica que se haya creado un boleto

        $ticket = Ticket::first(); //se crea una variable para el boleto

        $this->assertEquals('12345',$ticket->code); //se verifica que el codigo del boleto sea 12345
        $this->assertEquals('sur',$ticket->location); //se verifica que la ubicacion sea sur
        $this->assertEquals('100',$ticket->price);
        $this->assertEquals('1',$ticket->user_id);
        $this->assertEquals('1',$ticket->event_id);

        $response->assertStatus(201); //se verifica que el status sea 201

        $response ->assertJson([
            'data'=> [
    
                'type'=>'boleto',
                'boleto_id'=>$ticket->id,
                'attributes'=>[
                    
                    'user_id'=>[
                        'data'=>[
                        'user_id'=>$ticket->user->id,
                        ]
                        ],
                        'evento_id'=>[
                            'data'=>[
                            'evento_id'=>$ticket->event->id,
                            ]
                            ],
                    'code'=>$ticket->code,
                    'location'=>$ticket->location,
                    'price'=>$ticket->price,


                        
                ]
                     
            
            
                
                        
                    ],
                    
    
]); //se verifica que el json sea el correcto

        //se verifica que el boleto se haya guardado en la base de datos
        $this->assertDatabaseHas ('tickets',[
            'code'=>'12345',
            'location'=>'sur',
            'price'=>'100',
            'user_id' => '1',
            'event_id' => '1',
      
          ]);
    }
}
