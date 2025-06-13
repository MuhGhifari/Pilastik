<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showAll(){
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function show($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User Tidak Ditemukan!'], 404);
        }

        return response()->json(['user' => $user]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(User::ROLES)],
        ]); 

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json(['message' => 'User Ditambahkan!', 'user' => $user]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'username' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|required|string|min:6',
            'role' => ['required', Rule::in(User::ROLES)],
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json(['message' => 'User Diperbarui!', 'user' => $user]);
    }

    public function delete($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User Tidak Ditemukan!'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User Dihapus!']);
    }
}
