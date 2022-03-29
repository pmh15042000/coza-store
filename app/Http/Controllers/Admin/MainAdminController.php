<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Customer\CustomerService;
use App\Http\Services\Traffic\TrafficService;
use App\Models\Customer;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainAdminController extends Controller
{
    protected $traffic;
    protected $customer;
    protected $statistic;
    function __construct(TrafficService $traffic,CustomerService $customer)
    {
        $this->traffic = $traffic;
        $this->customer= $customer;
 
    }
    function index(){
     

        return view('admin.home',[  
            'title'=> 'Trang Quản Trị Admin',
            'total_views'=> $this->traffic->total_views(),
            'total_visitor'=> $this->traffic->total_visitors(),
            'total_customer' => $this->customer->total_customers(),
            'total_today' => $this->customer->total_totay(),
        ]);
    }
}
