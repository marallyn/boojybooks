<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNumBooksAttribute()
    {
        return count($this->list);
    }
    
    public function list()
    {
        // return $this->hasMany('App\Book');
        return $this->hasManyThrough(
            'App\Book',
            'App\BookUser',
            'user_id', // Foreign key on userbooks table...
            'id', // Foreign key on books table...
            'id', // Local key on user table...
            'book_id' // Local key on userbooks table...
        )->select('books.id', 'books.isbn', 'books.cover', 'books.author', 'books.pages', 'books.title', 'book_users.rank')
        ->orderBy('book_users.rank');
    }
}
