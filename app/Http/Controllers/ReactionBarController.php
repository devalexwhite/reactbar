<?php

namespace App\Http\Controllers;

use App\Models\ReactionType;
use App\Models\Site;
use App\Models\SiteReaction;
use Illuminate\Http\Request;

class ReactionBarController extends Controller
{
    public function show(Request $request)
    {
        $slug = $request->route('slug');
        $site = Site::where('slug', $slug)->firstOrFail();


        return view('embed.bar', [
            'site' => $site,
        ]);
    }

    public function react(Request $request, $slug)
    {
        $reactionTypeId = $request->input('reaction_type_id');
        $reactionType = ReactionType::findOrFail($reactionTypeId);
        $site = Site::where('slug', $slug)->firstOrFail();


        $ipDateHash = SiteReaction::hashUserIP($request->ip());

        $site->reactions()->updateOrCreate([
            'reaction_type_id' => $reactionType->id,
            'ip_date_hash' => $ipDateHash,
        ]);

        return view('embed.bar', [
            'site' => $site,
        ]);
    }
}
