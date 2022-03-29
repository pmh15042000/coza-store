<?php

namespace App\Models;

use App\Http\Services\Menu\MenuService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable= ['name','menu_id','price_sale','description','content','image','price','list_image','active','qty'];
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
