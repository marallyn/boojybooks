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
     * Gets the list entry associated with this book
     */
    public function listDetails()
    {
        return $this->hasOne('App\BookUser')->where('user_id', Auth::user()->id);
    }
}
