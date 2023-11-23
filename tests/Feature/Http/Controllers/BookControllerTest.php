<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
   
    use RefreshDatabase;

  /**
     * A Test to check if book index is rendered
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */       
public function test_the_index_page_is_rendered_properly()
{    
  $response = $this->get('/books');
  $response->assertStatus(200);
  $response->assertSee('Book List');
}

     /**
     * A Test to check if a specified book  is rendered
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  


     public function test_the_show_book_page_is_rendered_properly()
     {
 
       $user = User::factory()->create(['role' => 'admin']); 
       $book = Book::factory()->create(['user_id' => $user->id] );
       $response = $this->get("/books/{$book->id}");
       $response->assertStatus(200);
       $response->assertSee($book->name);
 
     }




  /**
     * A Test to check if user is cannot access
     * create book route
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 
public function test_user_cannot_visit_books_create_without_the_author_route(){

    $user = User::factory()->create(['role' => 'user']); 
    $this->actingAs($user);
    $response = $this->get('/books/create/0');
    $response->assertStatus(403);
   
   }

     /**
     * A Test to check if admin is can access
     * create book without the author route
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 
public function test_admin_can_visit_books_create_without_the_author_route(){

    $user = User::factory()->create(['role' => 'admin']); 
    $this->actingAs($user);
    $response = $this->get('/books/create/0');
    $response->assertStatus(200);
   
   }

     /**
     * A Test to check if admin can create book
     * wihout author
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 

public function test_admin_can_create_books_without_author()
{
    $user = User::factory()->create(['role' => 'admin']);
    $this->actingAs($user);
   
    $response = $this->post('/books', [
       'title' => 'a good book',
       'genre' => 'classic',
       'credit_price' => 100,
       'description' => 'A nice book',
       'status' => 'availiable'
    ]);
    $book = Book::first();
    $this->assertEquals(1, Book::count());
    $response->assertStatus(302);
    $response->assertRedirect("/admin/{$user->id}");
    $this->assertEquals('a good book', $book->title );
    $this->assertEquals($user->id, $book->createdBy->id );
   
}


  /**
     * A Test to check if admin can add books
     * to a author
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 

public function test_admin_can_add_books_to_author()
{
 $user = User::factory()->create(['role' => 'admin']);
 $author = Author::factory()->create(['user_id' => $user->id]);
 $this->actingAs($user);
 $response = $this->post('/books', [
    'title' => 'a good book',
    'genre' => 'classic',
    'credit_price' => 100,
    'description' => 'A nice book',
    'status' => 'availiable',
    'author_id' => $author->id
 ]); 
 $book = Book::first();
 $this->assertEquals(1, Book::count());
 $response->assertStatus(302);
 $response->assertRedirect("/admin/{$user->id}");
 $this->assertEquals('a good book', $book->title );
 $this->assertEquals($user->id, $book->createdBy->id );
 $this->assertEquals($author->id, $book->writtenBy->id );

}

  /**
     * A Test to check if admin can edit books
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 

public function test_admin_can_edit_books(){

    $user = User::factory()->create(['role' => 'admin']); 
    Book::factory()->create(['user_id' => $user->id] );
    $this->assertCount(1, Book::all());
    $book = Book::first();
    $response = $this->actingAs($user)->patch("/books/{$book->id}", [
        'title' => 'a good book',
        'genre' => 'classic',
        'description' => 'A nice book',
        'credit_price' => 10
    ]);
    $response->assertSessionHasNoErrors();
    $response->assertRedirect("/books/{$book->id}");
    $this->assertEquals('a good book', Book::first()->title);
    $this->assertEquals('classic', Book::first()->genre);
    $this->assertEquals('A nice book', Book::first()->description);

   }

    /**
     * A Test to check if admin can delete books
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 
public function test_admin_can_delete_book()
{ 
    $admin = User::factory()->create(['role' => 'admin']);
    $book = Book::factory()->create(['user_id' => $admin->id] );
    $this->assertEquals(1, Book::count());
    $response = $this->actingAs($admin)->delete("/books/{$book->id}" );
    $response->assertStatus(302);
    $this->assertEquals(0, Book::count());
}


   /**
     * A Test to check if user/book many-to-many
     * relationship exits and works properly
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */ 
public function test_user_borrow_book_relationship()
{
    $admin = User::factory()->create(['role' => 'admin']);
    $book = Book::factory()->create(['user_id'=> $admin->id ]);
    $user = User::factory()->create(['role'=> 'user']);
    $user->booksBorrowed()->attach($book->id);
    $this->assertCount(1, $user->fresh()->booksBorrowed);
    $this->assertEquals($book->id, $user->booksBorrowed->first()->id);
}







}