<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Str;
use Hash;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        //dd($request->all());
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
            if(Auth::User()->is_role == '1'){
                return redirect()->intended('admin/dashboard');
            }else if(Auth::User()->is_role == '0'){
                return redirect()->intended('student/dashboard');
            }else{
                return redirect()->back()->with('error', 'Please enter the correct credentials');
            }
        }else{
            return redirect()->back()->with('error', 'Please enter the correct credentials!');
        }
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function forgot(Request $request)
    {
       return view('auth.forgot');
    }

    public function register_post(Request $request)
    {
        //dd($request->all());

        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',


        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('/')->with('success', 'Register successfully.');


    }

    public function logout(){
        Auth::logout();
        return redirect(url('/'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
