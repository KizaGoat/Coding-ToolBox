<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\ProfilUserChange; // Assurez-vous d'importer ce modèle
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     *  Delete the user's account.
     * /
     *
     */

    public function updateProfileInfo(Request $request): RedirectResponse
    {
        // Validate the input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Retrieve the authenticated user who is attempting to update their profile
        $user = $request->user();
        // Check if the email has changed
        if ($user->email !== $validated['email']) {
            // If the email has changed, create a record in 'profil_user_changes' to track the email change
            $profileChange = new ProfilUserChange();
            $profileChange->user_id = $user->id;
            $profileChange->first_name = $validated['first_name'];
            $profileChange->last_name = $validated['last_name'];
            $profileChange->phone = $validated['phone'];
            $profileChange->email = $validated['email'];
            $profileChange->old_email = $user->email;
            $profileChange->avatar = $user->avatar;
            $profileChange->save();

            // Update the user email to the new value
            $user->email = $validated['email'];
        }

        // Update the other profile fields
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->phone = $validated['phone'];

        // If a new avatar has been uploaded, process the avatar file
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
        // Save the updated user data to 'users' table
        $user->save();

        // Redirect the user back to the profile
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

}
