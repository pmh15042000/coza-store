<?php

namespace App\Http\Middleware;

use App\Mail\TrafficMail;
use App\Models\Traffic;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TrafficMiddleware
{
   
    public function handle(Request $request, Closure $next)
    {
        $time = now();
    $visitor = $request->ip();
    $traffic = Traffic::firstOrCreate(['visitor' => $visitor]);
    $traffic->save();
    //Email notification
    $totalTraffic = Traffic::all()->sum('visits');
    $totalVisitors = Traffic::all()->count();
    Mail::to('hieupdlk55@gmail.com')->send(new TrafficMail($time,$visitor,$totalTraffic,$totalVisitors));
        return $next($request);
    }
}
