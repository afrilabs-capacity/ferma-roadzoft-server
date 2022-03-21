<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;

class PlatformController extends Controller
{
    //
    public function list(Request $request)
    {
        //return [auth()->user()->id];
        if (!$request->user()->isUserAuthorized()) {
            abort(403, 'Unauthorized action.');
        }

        return Platform::all();
    }

    public function create(Request $request)
    {
        if (!$request->user()->isUserAuthorized()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'string|required|max:255|unique:platforms',
            'description' => 'string|required|max:255',
        ]);
        Platform::create($validatedData);
    }

    public function edit($id, Request $request)
    {
        if (!$request->user()->isUserAuthorized()) {
            abort(403, 'Unauthorized action.');
        }
        $platform = Platform::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'string|max:255|unique:platforms,name,' . $id,
        ]);

        Platform::where('id', $id)->update($validatedData);
    }

    public function delete($id, Request $request)
    {
        if (!$request->user()->isUserAuthorized()) {
            abort(403, 'Unauthorized action.');
        }
        $platform = Platform::findOrFail($id);
        $platform->delete();
    }

    public function assignPLatform($platformId, $userId, Request $request)
    {
        if (!$request->user()->isUserAuthorized()) {
            abort(403, 'Unauthorized action.');
        }
        $platform = \App\Models\Platform::findOrFail($platformId);
        $user = \App\Models\User::findOrFail($userId);
        $platform->users()->attach($user);
        return ['looking good to attach'];
    }

    public function detachPLatform($platformId, $userId, Request $request)
    {
        if (!$request->user()->isUserAuthorized()) {
            abort(403, 'Unauthorized action.');
        }
        $platform = \App\Models\Platform::findOrFail($platformId);
        $user = \App\Models\User::findOrFail($userId);
        $platform->users()->detach($user);
        return ['looking good to detach'];
    }
}
