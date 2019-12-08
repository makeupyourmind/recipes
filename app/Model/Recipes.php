<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    protected $table = 'recipes';

    protected $fillable = [
        'id', 'name' ,'cooking', 'nutritionalValue', 'description', 'image', 'ingredients', 'category_id', 'user_id'
    ];

    public $timestamps = true;

    protected $casts = [  
        'ingredients' => 'array'
    ];

    public function category(){
        return $this->belongsTo('App\Model\Categories');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
