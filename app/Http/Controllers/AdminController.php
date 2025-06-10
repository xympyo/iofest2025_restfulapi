<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storybook;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function index(Request $request)
    {
        if (!auth()->check() || auth()->user()->email !== 'admin@admin.com') {
            abort(403, 'Unauthorized');
        }
        $storybooks = Storybook::with(['pages.panels.panels_content', 'genres'])
            ->orderBy('is_approved')
            ->orderByDesc('created_at')
            ->get();
        return view('admin_dashboard', compact('storybooks'));
    }

    // Approve a storybook (AJAX)
    public function approveStorybook(Request $request)
    {
        if (!auth()->check() || auth()->user()->email !== 'admin@admin.com') {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'id' => 'required|integer|exists:storybooks,id',
            'approve' => 'required|boolean',
        ]);
        $storybook = Storybook::findOrFail($request->id);
        $storybook->is_approved = $request->approve ? 1 : 0;
        $storybook->save();
        return response()->json(['success' => true, 'is_approved' => $storybook->is_approved]);
    }
}
