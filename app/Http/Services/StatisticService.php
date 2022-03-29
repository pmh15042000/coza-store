<?php 
namespace App\Http\Services;

use App\Models\Statistic;

class StatisticService{
   public function insert($data){
        Statistic::create([
            'date' => $data->date,
            'sales' => $data->sales,
            'qty' => $data->qty,
            'total_order' => $data->total_order,
        ]);
   }

   public function filterByDate($form,$to){
    return Statistic::whereBetween('date',[$form,$to])->orderBy('date','ASC')->get();
   }

}
?>