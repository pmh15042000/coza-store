<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name','parent_id','description','content','slug','active','thumb'];
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }
    public function childs(){
        return $this->hasMany(self::class,'parent_id','id');
    }

}
