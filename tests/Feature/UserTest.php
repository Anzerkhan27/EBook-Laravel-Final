<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Tests\Feature\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;
     

     /**
     * A Test to check if the user is being registered and
     * redirected to back to homepage
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */    
public function test_register_redirect_to_homepage_successfully(){
    $response = $this->post('/register', [
        'name' => 'test',
        'username' => 'test1',
        'email' => 'test@test.com',
        'password'=> FacadesHash::make('password')
    ]);   
        $response->assertStatus(302);
        $response->assertRedirect('/');
    
 }  
     /**
     * A Test to check if user can login with email & password and
     * redirected to back to homepage
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */   
 public function test_login_redirect_to_homepage_successfully(){

    User::factory()->create([
        'name' => 'test',
        'username' => 'test1',
        'email' => 'test@test.com',
        'password'=> FacadesHash::make('password')
    ]);

    $response = $this->post('/login', [
      'email' => 'test@test.com',
      'password' => 'password'

    ]);   
     $response->assertStatus(302);
     $response->assertRedirect('/');
 }

    /**
     * A Test to check if user is authenticated
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
 public function test_user_is_authenticated()
 {
     $user = User::factory()->create();
     $this->actingAs($user);
     $this->assertAuthenticated();
 }

   /**
     * A Test to check if admin can access its account page
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
 public function test_auth_admin_can_access_accountpage()
 {
     $this->withoutExceptionHandling();
     $admin = User::factory()->create(['role' => 'admin']);
     $this->actingAs($admin);
     $response = $this->get("/admin/{$admin->id}");
     $response->assertStatus(200);
 }

   /**
     * A Test to check if user can access its account page
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
 public function test_auth_user_can_access_accountpage()
 { 
     $this->withoutExceptionHandling();
     $user = User::factory()->create(['role' => 'user']);
     $this->actingAs($user);
     $response = $this->get("/user/{$user->id}");
     $response->assertStatus(200);
 }

    /**
     * A Test to check if user can access borrow book route
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
 public function test_auth_user_can__borrow_book()
 { 
     $admin = User::factory()->create(['role' => 'admin']);
     $user = User::factory()->create(['role' => 'user']);
     $book = Book::factory()->create(['user_id'=> $admin->id ]);
     $this->actingAs($user);
     $response = $this->post("/books/{$book->id}/borrow-book");
     $response->assertStatus(302);
 }


     /**
     * A Test to check if borrow book route is blocked
     * for admin 
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
 public function test_auth_admin_cant__borrow_book()
 { 
     $admin = User::factory()->create(['role' => 'admin']);;
     $book = Book::factory()->create(['user_id'=> $admin->id ]);
     $this->actingAs($admin);
     $response = $this->post("/books/{$book->id}/borrow-book");
     $response->assertStatus(403);
 }

 
     /**
     * A Test to check if admin can access the make admin route
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  

 public function test_admin_can_change_user_role(){

    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($admin);
    $response = $this->post("/user/{$user->id}/make-admin");
    $response->assertStatus(302);

   


 }
  /**
     * A Test to check if only borrower can view a book content
     * 
     * This was adapted from a youtube tutorial by Laraveller
     * youtube channel here:
     * https://www.youtube.com/watch?v=SmS5YcKL6Mc&t=2669s
     * 
     */  
 public function test_only_borrower_can_read_book(){

    $user1 = User::factory()->create(['role' => 'user']);
    $user2 = User::factory()->create(['role' => 'user']);
    $admin = User::factory()->create(['role' => 'admin']);;
    $book = Book::factory()->create(['user_id'=> $admin->id ]);
    $user1->booksBorrowed()->attach($book);
    $this->actingAs($user1);
    $response = $this->get("/books/view/{$book->id}");
    $response->assertStatus(200);
    $this->actingAs($user2);
    $response = $this->get("/books/view/{$book->id}");
    $response->assertStatus(403);
 }


}
