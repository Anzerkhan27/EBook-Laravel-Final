<?php

namespace App\Models;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Termwind\ask;

class Author extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'bio',
    ];


    //A one-to-many relationship wiht Book model    
    public function booksWritten()
    {
        return $this->hasMany(Book::class);
    }

    //A many-to-one relationship with User model
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
