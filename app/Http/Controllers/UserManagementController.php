<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
class UserManagementController extends Controller
{
public function index()
    {
        // Number of users per page
        $perPage = 10;

        // Get users ordered by newest first, paginated
        $users = User::orderBy('id', 'desc')->paginate($perPage);

        return view('user_management', compact('users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $users = User::where('name', 'like', "%$query%")->get();
        return response()->json($users);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        $user = User::find($request->id);
        $user->update($request->only(['name', 'email', 'role', 'status']));

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }
}