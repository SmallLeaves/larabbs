<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function show(User $user){
        return view('users.show',compact('user'));
    }
    public function edit(User $user){
        return view('users.edit',compact('user'));
    }
    public function update(Request $request,User $user){
        $this->validate($request,[
            'name' => 'required|max:50',
            'introduction' => 'nullable|max:140'
        ]);
        $user->update([
            'name' => $request->name,
            'introduction' => $request->introduction,
        ]);
        session()->flash('success','更新成功');
        return back();
    }
}
