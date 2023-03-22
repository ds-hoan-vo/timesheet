<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAnyUser', User::class);
        $user = Auth::user();
        if ($user->role === User::ADMIN) {
            $users = User::all();
        } else {
            $teams = $user->teams()->where('role', Team::LEADER)->get();
            $users = new Collection();
            foreach ($teams as $team) {
                $users = $users->merge($team->hasUsers()->get());
            }
        }
        return view('user.index', compact('users'));
    }
    public function create()
    {
        $this->authorize('createUser', User::class);
        return view('user.create');
    }

    public function profile(Request $request)
    {
        
        $user = Auth::user();
        $this->authorize('viewProfile', $user);
        return view('user.profile', compact('user'));
    }
    public function updateProfile(Request $request, User $model)
    {
        // $this->authorize('updateProfile', $model);
        $this->authorize('updateProfile', $model);
        $model->fill($request->all())->save();
        return redirect()->route('profile');
    }
    public function update(Request $request, User $model)
    {
        $this->authorize('updateUser', $model);
        $model->fill($request->all())->save();
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully'
        ], 200);
    }
    public function delete(Request $request, User $model)
    {
        $this->authorize('deleteUser', $model);
        $model->delete();
        //return response and redirect to index
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}