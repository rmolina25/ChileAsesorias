<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialMediaController extends Controller
{
    /**
     * Actualizar las redes sociales del usuario
     */
    public function update(Request $request)
    {
        $request->validate([
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'blog_url' => 'nullable|url',
        ]);

        User::where('id', Auth::id())->update($request->only([
            'linkedin_url',
            'instagram_url',
            'facebook_url',
            'twitter_url',
            'website_url',
            'blog_url',
        ]));

        return back()->with('social_media_success', 'Redes sociales actualizadas correctamente.');
    }
}
