<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ResetPassword;
use App\Models\User;

class PasswordController extends Controller
{
    public function reset(){
        return view('components.errors.forgot');
    }

    public function send_reset(Request $request){
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.',
            'user' => $request->email
        ];
        Mail::to($request->email)->send(new ResetPassword($mailData));
        return redirect('/');
    }

    public function reset_password_view($email){
        return view('components.emails.reset_password')->with('email',$email);
    }

    public function reset_password(Request $request){
        $user = User::where('email', $request->email)->first();
        $user->password = $request->password;
        $user->update();
        return redirect("/");
    }
}
