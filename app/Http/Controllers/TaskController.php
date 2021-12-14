<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }
    public function index(){ //method to show all data
       // $tasks = DB::table('tasks')->get();
            $tasks= Task::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(5);

         return view('tasks',compact('tasks'));
    }
    public function store(Request $request){// insert data
        DB::table('tasks')->insert([
            'name'=>$request['name'],
            'user_id'=>Auth::id(),
            'updated_at'=> now(),
            'created_at'=> now()


        ]);
        return redirect()->back();
    }
    public function delete($id){
        DB::table('tasks')->where('id','=',$id)->delete();

        return redirect()->back();
    }
    public function Update(Request $request , $id){

        $update=
        DB::table('tasks')->where('id',$id)->update([
            'name'=>$request['name'],
            'id'  =>$id
        ]);

        return redirect()->back();

    }


}
