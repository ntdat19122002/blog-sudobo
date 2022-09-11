<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Requests\PasswordRequest;
use App\Requests\UserRequest;
use App\Mail\ResetPassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Blog::latest()->paginate(5);

        return view('components.blogs.home', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function login(Request $request){
        $user = User::where('username',$request->username)->where('password',$request->password);
        if($user){
            $request->session()->put('user',$request->username);
            return redirect('blogs');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect('/');
    }


    public function profile(){
        return view('components.users.profile',compact());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required'
        ]);

        $user = new User;

        $user->username = $request->username;
        $user->password = $request->password;
        $user->email = $request->email;
        $request->session()->put('user',$request->username);
        // dd($user);
        $user->save();

        return redirect('/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->save();

        return redirect('blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
