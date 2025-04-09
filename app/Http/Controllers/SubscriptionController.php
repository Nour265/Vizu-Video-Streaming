<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function subscribe($channelId)
    {
        $user = Auth::user();

        $subscription = Subscription::where('UID', $user->UID)
            ->where('CID', $channelId)
            ->first();

        if ($subscription) {
            $subscription->delete();
            return response()->json(['status' => 'unsubscribed']);
        } else {
            Subscription::create([
                'UID' => $user->UID,
                'CID' => $channelId,
            ]);
            return response()->json(['status' => 'subscribed']);
        }
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
