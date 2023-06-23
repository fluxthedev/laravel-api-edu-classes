<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the users.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return response()->json(User::all());
  }

  /**
   * Display the specified user.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return response()->json(User::find($id));
  }

  /**
   * Store a newly created user in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'role' => 'required|in:Teacher,Student,Admin',
    ]);

    $user = User::create($request->all());

    return response()->json($user, 201);
  }

  /**
   * Update the specified user in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'role' => 'required|in:Teacher,Student,Admin',
    ]);

    $user = User::findOrFail($id);
    $user->update($request->all());

    return response()->json($user, 200);
  }

  /**
   * Remove the specified user from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::findOrFail($id)->delete();
    return response()->json(['message' => 'Deleted Successfully'], 200);
  }

  /**
   * Generate auth token for user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function generateToken(Request $request, $id)
  {
    $user = User::findOrFail($id);

    // Creating a token with specific permissions
    $token = $user->createToken('api-token', ['view-user'])->plainTextToken;

    return response()->json(['token' => $token], 201);
  }
}
