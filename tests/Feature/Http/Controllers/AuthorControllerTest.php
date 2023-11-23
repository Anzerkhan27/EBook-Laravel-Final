<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
  
       
    use RefreshDatabase;

      /**
     * A Test to check if author index is rendered
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */     
    
    public function test_the_index_page_is_rendered_properly()
    {

      $response = $this->get('/authors');
      $response->assertStatus(200);
      $response->assertSee('Author List');
    }

     /**
     * A Test to check if a specified author  is rendered
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  


    public function test_the_show_author_page_is_rendered_properly()
    {

      $user = User::factory()->create(['role' => 'admin']); 
      $author = Author::factory()->create(['user_id' => $user->id] );
      $response = $this->get("/authors/{$author->id}");
      $response->assertStatus(200);
      $response->assertSee($author->name);

    }


      /**
     * A Test to check if user is cannot access
     * create author route
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 
    public function test_user_cannot_visit_author_create_route(){
    
        $user = User::factory()->create(['role' => 'user']); 
        $this->actingAs($user);
        $response = $this->get('/authors/create');
        $response->assertStatus(403);
       }
       
       /**
     * A Test to check if admin can access
     * create author route
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */   
    public function test_admin_can_visit_author_create_rout(){
        $user = User::factory()->create(['role' => 'admin']); 
        $this->actingAs($user);
        $response = $this->get('/authors/create');
        $response->assertStatus(200);   
       }

    /**
     * A Test to check if admin can 
     * create authors
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */      
    public function test_admin_can_create_authors()
    {
     $user = User::factory()->create(['role' => 'admin']);
     $this->actingAs($user);
    
     $response = $this->post('/authors', [
        'name' => 'Mohammad',
        'bio' => 'a good man'
     ]);
     $author = Author::first();
     $this->assertEquals(1, Author::count());
     $response->assertStatus(302);
     $response->assertRedirect("/authors");
     $this->assertEquals('Mohammad', $author->name );
     $this->assertEquals('a good man', $author->bio );
     $this->assertEquals($user->id, $author->createdBy->id );
    
    }

       /**
     * A Test to check if admin can 
     * edit authors
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
    public function test_admin_can_edit_authors(){
    
    
        $user = User::factory()->create(['role' => 'admin']); 
        Author::factory()->create(['user_id' => $user->id] );
        $this->assertCount(1, Author::all());
        $author = Author::first();
        $response = $this->actingAs($user)->patch("/authors/{$author->id}", [
            'name' => 'Mohammad',
            'bio' => 'a good man'
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/authors");
        $this->assertEquals('Mohammad', Author::first()->name);
        $this->assertEquals('a good man', Author::first()->bio);
     
    
       }
      
       /**
     * A Test to check if admin can 
     * delete authors
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
       public function test_admin_can_delete_authors()
       { 
        $admin = User::factory()->create(['role' => 'admin']);
        $author = Author::factory()->create(['user_id' => $admin->id] );
        $this->assertEquals(1, Author::count());
        $response = $this->actingAs($admin)->delete("/authors/{$author->id}" );
        $response->assertStatus(302);
        $response->assertRedirect("/authors");
        $this->assertEquals(0, Author::count());
       }
    }




