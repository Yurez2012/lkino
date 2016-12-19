<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Auth;
use Illuminate\Http\Request;

class RegController extends Controller
{
    public function create()
    {
        return view('auth.reg');
    }


    /**
     * @param CreateUser|Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(CreateUser $request)
    {
        $request = new Auth($request->all());
        $request['law'] = 'quest';
        Auth::create($request->getAttributes());

        return redirect('reg/show');
    }

    public function show()
    {
        return view("auth.show");
    }
}
