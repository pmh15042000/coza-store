<?php 
namespace App\Http\Services\Customer;

use App\Models\Customer;
use Carbon\Carbon;

class CustomerService{
    function total_customers(){
        return Customer::count();
    }
    function total_totay(){
        return Customer::whereDate('created_at', Carbon::today())->count();
    }

   
    
}
?>