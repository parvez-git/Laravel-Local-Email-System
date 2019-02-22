<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'message_to', 'subject', 'body', 'status'];


    public function fromUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }    

    public function toUser()
    {
        return $this->belongsTo('App\User', 'message_to');
    }
}
