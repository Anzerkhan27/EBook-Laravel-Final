<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
class UserSeeder extends Seeder
{
    public function run()
    {

        //Login credentials for admin, password = password
        User::factory()
        ->count(1)
        ->create([
        'email' => 'admin@email.com',
        'role' => 'admin'
        ]);

        User::factory(5)->create(['role'=> 'admin' ])->each(function($user)  {
            Author::factory(rand(1, 5))->create([
                'user_id' => $user->id
            ])->each(function($author) use($user) {
            Book::factory(rand(1, 5))->create([
                    'user_id' => $user->id,
                    'author_id'=> $author->id
                ])->each(function($book){

                $users = User::factory(20)->create(['role' => 'user']);
                $book->borrowedBy()->attach($users->random(2));
                });
            });
        });
       
    
           
       
    
      


}   }