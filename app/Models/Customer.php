<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable= ['name','phone','email','adress','content'];
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    
}
