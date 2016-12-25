<?php

namespace App\Http\Controllers;


use App\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AuthUser;
use Illuminate\Support\Facades\Session;

class AutheController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function auth()
    {

        $user = Session::get('user');
        if(!empty($user)) {
            return redirect('news');
        }else {
            return view('auth.auth');
        }


    }


    /**
     * @param AuthUser $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(AuthUser $request)
    {
        $user = Session::get('user');
        if(!empty($user)) {
            return redirect('news');
        }else {
            $user = new Auth($request->all());
            $user = $user->getAttributes();

            $userAuth = Auth::where('name', $user['name'])
                ->get();

            if(!isset($userAuth[0])) {
                return redirect('auth/user');
            }else {
                $userAuthPass = $userAuth[0];
                $userAuthPass = $userAuthPass->getAttributes();
                $pass = password_verify($user['password'], $userAuthPass['password']);

                if($pass) {

                    session([
                        'user' => $userAuthPass['name'],
                        'law' => $userAuthPass['law'],
                    ]);

                    return redirect('news');
                }else {
                    return redirect('auth/user');
                }
            }

        }


    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function logout()
    {

        session()->flush();

        return redirect('news');
    }

}
