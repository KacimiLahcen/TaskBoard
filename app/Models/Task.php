<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [ //the allowed inputs to remplir by laravel when create,update 
        'user_id', 'title', 'description', 'priority', 'status', 'deadline'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
