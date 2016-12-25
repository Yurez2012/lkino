<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegController extends Controller
{
    public function create()
    {

        $user = Session::get('user');
        if(!empty($user)) {
            return redirect('news');
        }else {
            return view('auth.reg');
        }

    }

    /**
     * @param CreateUser|Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(CreateUser $request)
    {


        $user = Session::get('user');
        if(!empty($user)) {
            return redirect('news');
        }else {
            $request = new Auth($request->all());
            $request['law'] = 'quest';
            $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
            Auth::create($request->getAttributes());

            return redirect('reg/show');
        }
    }

    public function show()
    {
        $user = Session::get('user');
        if(!empty($user)) {
            return redirect('news');
        }else {
            return view("auth.show");
        }


    }
}
