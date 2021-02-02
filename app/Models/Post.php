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

    // mutator - to show uploaded images without path issues
    // public function setPostImageAttribute($value){
    //     // before this store in database this function invokes and
    //     // set path by using asset
    //     $this->attributes['post_image'] = asset($value);
    // }

    //  another way to do that accessor
    public function getPostImageAttribute($value){
        // this won't modify data in databse just add path when we access
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }
}
