<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistic:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterday = "2022-03-12";
        $total_order = Customer::whereDate('created_at',$yesterday)->count();
        $list_order =Customer::whereDate('created_at',$yesterday)->with('carts')->get()->toArray();
        $total_qty = 0;
        $total_price = 0;
        foreach($list_order as $order ){
            $total_qty += $order['carts']['0']['qty'];
            $total_price += $order['carts']['0']['price'];
        }
        Statistic::create([
            'date'=> $yesterday,
            'sales'=> $total_price,
            'qty'=> $total_qty,
            'total_order'=>$total_order
        ]);
        return 0;
    }
}   
