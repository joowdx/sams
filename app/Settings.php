<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'user_id', 'name', 'value',
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
