<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAnyUser', User::class);
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function create()
    {
        return view('user.create');
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $this->authorize('viewProfile', $user);
        return view('user.profile', compact('user'));
    }
    public function update(Request $request, User $model)
    {   
        // $this->authorize('updateProfile', $model);
        $this->authorize('updateProfile', $model);
        $model->fill($request->all())->save();
        return redirect()->route('profile');
    }
}
