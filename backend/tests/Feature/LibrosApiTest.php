<?php

namespace Tests\Feature;

use App\Models\Libro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibrosApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_libros()
    {
        $libros = Libro::factory(6)->create();
        
        $response = $this->getJson(route("libros.index"));
        $response->assertJsonFragment([
            'titulo' => $libros[0]->titulo
        ])->assertJsonFragment([
            'titulo' => $libros[1]->titulo
        ]);
    }

    /** @test */
    public function can_get_one_libros()
    {
        $libros = Libro::factory()->create();
        
        $response = $this->getJson(route("libros.show",$libros));
        $response->assertJsonFragment([
            'titulo' => $libros->titulo
        ]);
    }
    
    /** @test */
    public function can_create_libros()
    {
        $this->postJson(route("libros.store",[]))
        ->AssertJsonValidationErrorFor('titulo') ;

        $this->postJson(route("libros.store",[
            "titulo"=>"Nuevo Titulo",
            "autor"=>"Nuevo Autor"
        ]))->assertJsonFragment([
            "titulo"=>"Nuevo Titulo",
            "autor"=>"Nuevo Autor"
        ]);
        
        $this->assertDatabaseHas('libros',[
            "titulo"=>"Nuevo Titulo",
            "autor"=>"Nuevo Autor"
        ]);
    }
    
    /** @test */
    public function can_update_libros()
    {

        $libro = Libro::factory()->create();
        $this->patchJson(route("libros.update",$libro))
        ->AssertJsonValidationErrorFor('titulo') ;

        $this->patchJson(route("libros.update",$libro),[
            "titulo"=>"Editar Titulo",
            "autor"=>"Editar Autor"
        ])->assertJsonFragment([
            "titulo"=>"Editar Titulo",
            "autor"=>"Editar Autor"
        ]);
        
        $this->assertDatabaseHas('libros',[
            "titulo"=>"Editar Titulo",
            "autor"=>"Editar Autor"
        ]);
    }
    
    /** @test */
    public function can_delete_libros()
    {

        $libro = Libro::factory()->create();

        $this->deleteJson(route("libros.destroy",$libro))->assertNoContent();
        
        $this->assertDatabaseCount('libros',0);
    }

     
}
