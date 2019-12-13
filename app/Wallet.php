<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
          'value',
          'type',
          'source',
          'date',
        'user_id'
    ];

    public $timestamps = false;

    public function User ()
    {
        return $this->belongsTo('User');
    }
}
