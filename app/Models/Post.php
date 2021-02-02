<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    // equal to fillable, it won't restrict any column to be fillable

    public function user(){
        return $this->belongsTo(User::class);
    }
}
