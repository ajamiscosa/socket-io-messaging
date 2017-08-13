<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['name','email','subject','message'];

    public function unread()
    {
        return $this->where('seen','=',0)->get();
    }
}
