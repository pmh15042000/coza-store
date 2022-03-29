<?php 
namespace App\Http\Services\Traffic;

use App\Models\Traffic;

class TrafficService{
    function total_views(){
        return Traffic::sum('visits');
    }
    function total_visitors(){
        return Traffic::distinct('visitor')->count('visitor');
    }
    
}
?>