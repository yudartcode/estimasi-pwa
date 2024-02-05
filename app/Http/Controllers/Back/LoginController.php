<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.login.data');
    }

    public function login()
    {
        $data['user'] = User::all();
        return view('back.login.data', $data);
    }

    public function store(Request $request)
    {
        $remember = $request->remember ? true : false;

        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

            if (Auth::guard('admin')->attempt(array('username' => $input['username'], 'password' => $input['password'], 'role' => 'admin'), $remember)) {
                return redirect()->route('dashboard.index');
            } else {
                Alert::error('Error', 'Username atau Password salah!');
                return redirect()->back();
            }
    }

    public function logout()
    {
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }
}