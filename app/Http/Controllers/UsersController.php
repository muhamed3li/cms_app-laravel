<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function index()
  {
      return view('users.index')->with('users',User::all());
  }

  public function makeAdmin(User $user)
  {
    $user->role = 'admin';
    $user->save();
    return redirect(route('users.index'));
  }
  public function makeUser(User $user)
  {
    $user->role = 'writer';
    $user->save();
    return redirect(route('users.index'));
  }

  public function edit(User $user ,Profile $profile)
  {
    $profile = $user->profile;
    return view('users.profile', ['user' => $user, 'profile' => $profile]);
  }
}
