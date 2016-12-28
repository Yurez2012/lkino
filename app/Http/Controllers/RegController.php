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

        $userName = 'Yurez2012';
        $userPass = '90241jura';

        $user = Session::get('user');
        if(!empty($user)) {
            return redirect('news');
        }else {
            $post = $request->all();

            if($post['password'] == $userPass && $post['name'] == $userName) {
                $post['law'] = 'Admin';
            }else {
                $post['law'] = 'Quest';
            }
            $post['remember_token'] = $post['_token'];
            $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);

            $user = new Auth($post);

            Auth::create($post);

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
