<?php

namespace App\Http\Controllers;

use App\Models\Maschat;
use Illuminate\Http\Request;

class MasChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maschats = Maschat::with('user')
            ->latest()
            ->take(50)  // Limit to 50 most recent maschats
            ->get();

        return view('home', ['maschats' => $maschats]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Maschat::class);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to MasChat!',
            'message.max' => 'MasChats must be 255 characters or less.',
            // Rule::unique('maschats')->where(function ($query) use ($user) {
            //     return $query->where('user_id', $user->id);
            // })->ignore($user->id, 'user_id')->whereNull('user_id')->messages(),
        ]);
    
        auth()->user()->maschats()->create($validated);    
        return redirect('/')->with('success', 'Your MasChat has been posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maschat $maschat)
    {
        $this->authorize('update', $maschat);
        return view('maschat.edit', compact('maschat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maschat $maschat)
    {
        $this->authorize('update', $maschat);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to MasChat!',
            'message.max' => 'MasChats must be 255 characters or less.',
        ]);

        $maschat->update($validated);

        return redirect('/')->with('success', 'MasChat updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maschat $maschat)
    {
        $this->authorize('delete', $maschat);
        $maschat->delete();
        return redirect('/')->with('success', 'MasChat deleted!');
    }
}
