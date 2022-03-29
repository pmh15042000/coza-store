<?php
namespace App\Helpers;

use Illuminate\Support\Str;
class Helper{
    public static function menu($menus, $parent_id = 0, $char= ''){

        // duyệt mảng
        foreach($menus as $key=>$menu)
        {
            // kiểm tra mảng có danh mục cha ko
            if($menu->parent_id == $parent_id)
            {
                    echo '<tr>';
                        echo '<td>' .$menu->id.'</td>';
                        echo '<td>' .$char . $menu->name .'</td>';
                        echo ' <td>' .self::format_active($menu->active).'</td>';
                        echo '<td>' .$menu->updated_at.'</td>';
                        echo '<td>' .$menu->slug.'</td>';
                        echo '<td><a class="btn btn-primary btn-sm" href="menu/edit/'.$menu->id.'"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" onclick="removeRow('.$menu->id.',\'menu/destroy\')" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>';
                    echo '</tr>';
                 unset($menus[$key]);
                 self::menu($menus,$menu->id,$char.'--');
            }
        }
    }
    public static function format_active($active){
        return $active==0 ? '<span class="btn btn-danger btn-xs">NO</span>': '<span class="btn btn-success btn-xs">YES</span>';
    }  
    public static function menus($menus, $parent_id = 0) :string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            ' . $menu->name . '
                        </a>';

                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }
    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }
    public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) return '$'.number_format($priceSale);
        if ($price != 0)  return '$'.number_format($price);
        return '<a href="/lien-he.html">Liên Hệ</a>';
    }
    
}
?>