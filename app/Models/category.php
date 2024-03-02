<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public function parentCategory(){
        return $this->hasOne('App\Models\category','id','parent_id')->select('id','category_name','url')->where('status',1);
    }
}
