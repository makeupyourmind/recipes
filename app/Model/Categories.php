<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id', 'name'
    ];

    public $timestamps = true;

    public function recipes(){
        return $this->hasMany('App\Model\Recipes');
    }
}
