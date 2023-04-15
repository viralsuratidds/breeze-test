<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return Inertia::render('Users/Index', ['users' => $users]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ])->validate();

        $request['password'] = Hash::make($request['password']);
   
        User::create($request->all());
    
        return redirect()->route('users.index');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(User $user)
    {

        $user = User::find($user->id);
        return Inertia::render('Users/Edit', [
            'user' => '$user'
        ]);
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
        ])->validate();
    
        User::find($id)->update($request->all());
        return redirect()->route('users.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index');
    }
}
