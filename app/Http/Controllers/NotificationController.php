<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->paginate(10);

        return view('backend.notification.index', [
            'notifications' => $notifications,
            'page_title' => 'Notifications'
        ]);
    }

    public function create()
    {
        return view('backend.notification.create', [
            'page_title' => 'Create Notification'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'nullable|boolean', // ✅ Validate status
        ]);

        try {
            $notification = new Notification();
            $notification->title = $request->title;
            $notification->status = $request->status ?? 1; // ✅ Default to ON

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/notifications'), $imageName);
                $notification->image = $imageName;
            }

            if ($notification->save()) {
                return redirect()->route('admin.notifications.index')
                    ->with('success', 'Notification created successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! Notification not created.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);

        return view('backend.notification.edit', [
            'notification' => $notification,
            'page_title' => 'Edit Notification'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'nullable|boolean', // ✅ Validate status
        ]);

        try {
            $notification = Notification::findOrFail($id);
            $notification->title = $request->title;
            $notification->status = $request->status ?? 0; // ✅ Default to OFF if not checked

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($notification->image && File::exists(public_path('uploads/notifications/' . $notification->image))) {
                    File::delete(public_path('uploads/notifications/' . $notification->image));
                }

                $imageName = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/notifications'), $imageName);
                $notification->image = $imageName;
            }

            if ($notification->save()) {
                return redirect()->route('admin.notifications.index')
                    ->with('success', 'Notification updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! Notification not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $notification = Notification::findOrFail($id);

            // Delete image if exists
            if ($notification->image && File::exists(public_path('uploads/notifications/' . $notification->image))) {
                File::delete(public_path('uploads/notifications/' . $notification->image));
            }

            if ($notification->delete()) {
                return redirect()->route('admin.notifications.index')
                    ->with('success', 'Notification deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! Notification could not be deleted.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * ✅ Toggle notification status (On/Off)
     */
    public function toggleStatus($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->status = !$notification->status;
        $notification->save();

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification status updated successfully.');
    }
}
