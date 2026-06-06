<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeEdit extends Model
{
    protected $table = 'home_edit';
    
    public $timestamps = false;
   
    protected $fillable = [
         'pages',
         'content',
     ];

     protected $casts= [
        'content' => 'array',
     ];
}
   