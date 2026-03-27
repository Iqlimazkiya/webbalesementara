<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
            ActivityLogger::log(
                'Pesan masuk dibaca',
                'Pesan dari "' . ($message->name ?? 'Pengunjung') . '" ditandai sudah dibaca'
            );
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        ActivityLogger::log(
            'Pesan masuk ditandai dibaca',
            'Pesan dari "' . ($message->name ?? 'Pengunjung') . '" ditandai sudah dibaca'
        );

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $name = $message->name ?? 'Pengunjung';
        $message->delete();

        ActivityLogger::log(
            'Pesan masuk dihapus',
            'Pesan dari "' . $name . '" dihapus dari sistem'
        );

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus');
    }
}