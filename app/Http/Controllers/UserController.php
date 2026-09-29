<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Rules\Uppercase;

class UserController extends Controller
{
    public function index()
    {
        return view('user-form');
    }

    public function submitForm(UserRequest $request)
    {
        $request->validate([
            'name' => ['required', new Uppercase],
        ]);

        return "Data berhasil divalidasi!";
    }
}
