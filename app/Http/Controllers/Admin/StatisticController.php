<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\StatisticService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $statistic;
    public function __construct(StatisticService $statistic)
    {
        $this->statistic = $statistic;
    }
    public function daysorder(){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $get = $this->statistic->filterByDate($sub30days,$now);
        foreach($get as $key=> $val){
            $chart_data[]= array(
                'period' => $val->date,
                'order' => $val->total_order,
                'qty' => $val->qty,
                'sales' =>  number_format($val->sales)
            );
        }
        return json_encode($chart_data);
    }
    public function filterByDate(Request $request){
        $from= $request->form_date;
        $to =  $request->to_date;
        $get = $this->statistic->filterByDate($from,$to);
        foreach($get as $k => $val){
            $chart_data[]= array(
                'period' => $val->date,
                'order' => $val->total_order,
                'qty' => $val->qty,
                'sales' => number_format($val->sales),
            );
        }
        return json_encode($chart_data);
    }
    public function filterByOption(Request $request){
        $option = $request->filter;
        $chart_data[]= ""; 
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($option == '7days'){
            $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
            $get = $this->statistic->filterByDate( $sub7days,$now);
        }elseif($option == 'lastmonth'){
            $earlylastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->firstOfMonth()->toDateString();
            $endlastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
            $get = $this->statistic->filterByDate($earlylastmonth, $endlastmonth);
        }elseif ($option == 'currentmonth') {
            $earlycurrentmonth = Carbon::now('Asia/Ho_Chi_Minh')->firstOfMonth()->toDateString();
            $get = $this->statistic->filterByDate($earlycurrentmonth,$now);
        }else{
            $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
            $get = $this->statistic->filterByDate($sub365days,$now);
        }
        foreach($get as $k => $val){
            $chart_data[]= array(
                'period' => $val->date,
                'order' => $val->total_order,
                'qty' => $val->qty,
                'sales' => number_format($val->sales),
            );
        }
        return json_encode($chart_data);
    }
    
}
