<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function showAll(){
        $notifications = Notification::all();
        return response()->json(['notifications' => $notifications]);
    }

    public function show($id) {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notifikasi Tidak Ditemukan!'], 404);
        }

        return response()->json(['notification' => $notification]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'user_id' => 'required|integer',
        ]); 

        $notification = Notification::create($validated);

        return response()->json(['message' => 'Notifikasi Ditambahkan!', 'notification' => $notification]);
    }

    public function update(Request $request, $id) {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notifikasi Tidak Ditemukan!'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'message' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|integer',
        ]);

        $notification->update($validated);

        return response()->json(['message' => 'Notifikasi Diperbarui!', 'notification' => $notification]);
    }

    public function delete($id) {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notifikasi Tidak Ditemukan!'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notifikasi Dihapus!']);
    }
}
