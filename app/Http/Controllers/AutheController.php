<?php

namespace App\Http\Controllers;


use App\Auth;
use App\User;
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


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function admin()
    {
        $user = Session::get('user');
        $law = Session::get('law');

        if(!empty($user) and $law == 'admin') {

            $users = Auth::all();

            return view('auth.admin', compact('users'));
        }else {
            return redirect('news');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function delete(Request $request)
    {
        $user = Session::get('user');
        $law = Session::get('law');

        if(!empty($user) and $law == 'admin') {
            $user = $request->all();
            $user = Auth::find($user['id'])->delete();
            return redirect('auth/admin');
        }else {
            return redirect('news');
        }
    }

    public function edit(Request $request)
    {
        $user = Session::get('user');
        $law = Session::get('law');

        if(!empty($user) and $law == 'admin') {
            $users = $request->all();
            $users = Auth::find($users['id']);
            return view('auth.edit', compact('users'));
        }else {
            return redirect('news');
        }
    }

    public function update(Request $request)
    {
        $post = $request->all();
        $post['remember_token'] = $post['_token'];
        $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        $user = Auth::find($post['id']);
        $user->fill($post);
        $user->push();

        //Подумати якщо міняю law то міняется сесія на user якому міняю
        session()->flush();
        session([
            'user' => $post['name'],
            'law' => $post['law'],
        ]);

        return redirect('auth/admin');
    }

}
