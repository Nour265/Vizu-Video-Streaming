<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request, $id): View
    {        
        $user = User::findOrFail($id);
        return view('profile.show', compact('user'));
    }
    
    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }
    
    public function update(Request  $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->UID . ',UID',
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer',
        ]);

        $user->update($validated);
        return Redirect::route('profile.show', $user)->with('success', 'Profile updated successfully.');
    }

    
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
