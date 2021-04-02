<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function update(ProfileRequest $request) 
    {
        $errors = [];
        $user = Auth::user();

        if ($request->isMethod('post')) {

            $request->validated();

            if (Hash::check($request->post('password'), $user->password)) {
                $user->fill([
                    'name' => $request->post('name'),
                    'password' => Hash::make($request->post('newPassword')),
                    'email' => $request->post('email')
                ])->save();

                return redirect()->route('user.updateProfile')
                                 ->with('success', 'Профиль успешно изменен!');
            } else {
                $errors['password'][] = 'Неверно введен текущий пароль';

                return redirect()->route('user.updateProfile')
                                 ->withErrors($errors);
            }
        }

        return view('user.profile', [
            'user' => $user
        ]);
    }

}
