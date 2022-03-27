<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //test listar eventos
    public function test_list_events()
    {
        $this->withoutExceptionHandling();

        Event::factory()->create();
        
        $response=$this->get('/api/eventos');
        $response->assertOk();
        $event=Event::all(); 
                $response ->assertJson([
                    'data'=> [
                        [
                            'data'=>[
                                'type'=>'evento',
                                'evento_id'=>$event->first()->id,
                                'attributes'=>[
                                    'place'=>$event->first()->place,
                                    'city'=>$event->first()->city,
                                    'date'=>$event->first()->date,
                                    'category'=>$event->first()->category,
                                   
                                ]
                            ]
                                        ]
                                    ],
                    
                ]);
            }
     //test para crear evento 
    public function test_event_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/api/evento',[
           'place'=>'Calle falsa 123',
           'city'=>'Medellin',
           'date'=>'2020-05-05',
           'category'=>'Deportes',
        ]);

        $this->assertCount(1,Event::all());

        $event = Event::first();

        // aqui se verifica que los datos del comprador sean los mismos que se enviaron en el request
        $this->assertEquals('Calle falsa 123',$event->place);
        $this->assertEquals('Medellin',$event->city);
        $this->assertEquals('2020-05-05',$event->date);
        $this->assertEquals('Deportes',$event->category);
        
       
        $response->assertStatus(201);         // aqui se verifica que el comprador se haya creado correctamente
       
        $response ->assertJson([
            'data'=>[
                'type'=>'evento',
                'evento_id'=>$event->id,
                'attributes'=>[
                    'place'=>$event->place,
                    'city'=>$event->city,
                    'date'=>$event->date,
                    'category'=>$event->category,  
                ]
            
                        
                    ],
    
]);

    // se verifica que el evento se haya guardado en la base de datos
    $this->assertDatabaseHas ('events',[
      'place'=>'Calle falsa 123',
        'city'=>'Medellin',
        'date'=>'2020-05-05',
        'category'=>'Deportes',

    ]);
                
    }

    //test para ver un evento
    public function test_event_can_be_viewed()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create();

        $response = $this->get('/api/evento/'.$event->id);

        $response->assertOk();

        $response ->assertJson([
            'data'=>[
                'type'=>'evento',
                'evento_id'=>$event->id,
                'attributes'=>[
                    'place'=>$event->place,
                    'city'=>$event->city,
                    'date'=>$event->date,
                    'category'=>$event->category,
                ]
            ]
        ]);
    }
    //test para actualizar evento
    public function test_event_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create();

        $response = $this->putJson('/api/evento/'.$event->id,[
            'place'=>'Zakary Becker',
            'city'=>'Medellin',
            'date'=>'2020-05-05',
            'category'=>'Deportes',
        ]);
        $this->assertCount(1,Event::all());
                                    
                                    
        $event = $event->fresh();

        $event = Event::first();

        // aqui se verifica que los datos del comprador sean los mismos que se enviaron en el request
        $this->assertEquals('Zakary Becker',$event->place);
        $this->assertEquals('Medellin',$event->city);
        $this->assertEquals('2020-05-05',$event->date);
        $this->assertEquals('Deportes',$event->category);
        
       
        $response->assertStatus(200);         // aqui se verifica que el comprador se haya creado correctamente
       
        $response ->assertJson([
            'data'=>[
                'type'=>'evento',
                'evento_id'=>$event->id,
                'attributes'=>[
                    'place'=>$event->place,
                    'city'=>$event->city,
                    'date'=>$event->date,
                    'category'=>$event->category,  
                ]
            
                        
                    ],
        ]);
    }

    //test para eliminar evento
    public function test_event_can_be_deleted() 
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create(); // se crea un evento

        $response = $this->deleteJson('/api/evento/'.$event->id); // se elimina el evento

        $response->assertStatus(204); // se verifica que el evento se haya eliminado correctamente

        $this->assertCount(0,Event::all()); 
        
        
        $this->assertDatabaseMissing('events',[
            'place'=>'Zakary Becker',
            'city'=>'Medellin',
            'date'=>'2020-05-05',
            'category'=>'Deportes',
         ]); //!consulta en la tabla que no contiene los datos proporcionados.
    }
}
