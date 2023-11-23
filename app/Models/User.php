<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'credits',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // The one-to-many relationshio with BOOK model
    public function booksCreated()
    {
        return $this->hasMany(Book::class);
    }

    // The one-to-many relationshio with BOOK model
    public function authorsCreated()
    {
        return $this->hasMany(Author::class);
    }

    // The many-to-many relationshio with BOOK model
    public function booksBorrowed()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    /**
     * A function to check the date when the relationship was created 
     * i.e. book borrowed date and add 7 days to it
     * and return the date 
     * This was adapted from an anwser from Rahul on Aug 28 2019 posted on StackOverflow here:
     * https://stackoverflow.com/questions/57692600/add-days-to-date-in-laravel#:~:text=You%20can%20add%20dates%20to,%2D%3EaddDays(%24daysToAdd)%3B
     * 
     * 
     * @param $id
     * return $date
     */
    public function getExpiryDate($id)
    {
        $date = Carbon::parse(($this->booksBorrowed()->findorfail($id)->pivot->created_at))->addDays(7);
        $date = Carbon::parse($date)->toDateString();
        return $date;
    }
}
