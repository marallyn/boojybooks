<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    /**
     * Make all the attributes fillable by guarding none.
     */
    protected $guarded = [];

    /**
     * Get the user associated with this book
     */
    public function listDetails()
    {
        return $this->hasOne('App\BookUser')->where('user_id', Auth::user()->id);
    }
}
