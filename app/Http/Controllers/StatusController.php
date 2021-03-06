<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Status;
use Auth;
class StatusController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Request $request){
        $this->validate($request,[
            'content'=>'required|max:140'
        ]);
        Auth::user()->satuses()->create([
            'content'=>$request['content']
        ]);
        return redirect()->back();
    }
    public function destroy(Status $status){
        $this->authorize('destory',$status);
        $status->delete();
        session()->flash('success','微博已被成功删除！');
        return redirect()->back();
    }
}
