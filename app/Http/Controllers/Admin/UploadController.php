<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;
class UploadController extends Controller
{
    //
    protected $upload;
    function __construct(UploadService $upload)
    {
        $this->upload= $upload;
    }
    function store(Request $request){
        $url=   $this->upload->store($request);
        if($url != false){
            return response()->json([
               'error' => false,
               'url' => $url 
            ]);
        }
        return response()->json(['error'=>true]);
    }
    function storeSlider(Request $request){
        $url = $this->upload->storeSlider($request);
        if($url != false){
            return response()->json([
               'error' => false,
               'url' => $url 
            ]);
        }
        return response()->json(['error'=>true]);
    }
    function storeMenu(Request $request){
        $url = $this->upload->storeMenu($request);
        if($url != false){
            return response()->json([
               'error' => false,
               'url' => $url 
            ]);
        }
        return response()->json(['error'=>true]);
    }

}
