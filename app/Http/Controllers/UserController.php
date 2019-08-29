<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $user=$request->user();
        if($user->id){
            $rooms=\DB::select('SELECT * FROM rooms where id=?',[2]);
        }else{
            $rooms=\DB::select('SELECT * FROM rooms where id=?',[1]);        
        }
        return $rooms;
    }
    public function store(Request $request)
    {
        $user=new User;
        $user->id=$request->id;
        $user->na=$request->na;
        $user->avatar=$request->avatar;
        $user->save();
        return ['res' => 'ok'];
    }
    public function show($id)
    {
        return User::find($id);
    }
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->na=$request->na;
        $user->avatar=$request->avatar;        
        $user->save();
        return ['res' => 'ok'];
    }    
}
