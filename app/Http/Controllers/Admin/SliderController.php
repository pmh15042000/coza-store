<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\SliderRequest;
use App\Http\Requests\Admin\Slider\UpdateSliderRequest;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderService $slider)
    {
        $this->slider= $slider;
    }
    public function index(){

        return view('admin.slider.show',['title'=>'Danh sách slider','slider'=>$this->slider->getAll()]);
    }
    public function create(){
        return view('admin.slider.add',['title'=>'Danh sách slider']);
    }
    public function store(SliderRequest $request){
     
        $this->slider->insert($request);
        return redirect()->back();
    }
    public function getSliderByID(Slider $id){
        return response()->json($id);
    }
    public function update(UpdateSliderRequest $request){
        $this->slider->update($request);
        return redirect()->route('slider.list');
    }
    public function destroy($id){
       $result= $this->slider->destroy($id);
       if($result == false){
        Session::flash('error','Xóa bản ghi thất bại ');
        return redirect()->route('slider.list');
        }
        Session::flash('success','Xóa thành công bản ghi');
        return redirect()->route('slider.list');
    }
}
