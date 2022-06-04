<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
   protected $table='message';
    // use HasFactory;
    protected $fillable = ['message','from','to'];
    public $rules = [
        'message' => 'required',
        'from' => 'required',
        'to' => 'required'
    ];

    protected $with = ['sender','receiver'];

    public function sender()
    {
       return $this->hasOne('App\Models\User','id','from');
    }

    public function receiver()
    {
       return $this->hasOne('App\Models\User','id','to');
    }
}
