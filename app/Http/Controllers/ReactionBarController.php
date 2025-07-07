<?php

namespace App\Http\Controllers;

use App\Models\ReactionType;
use App\Models\Site;
use App\Models\SiteReaction;
use Illuminate\Http\Request;

class ReactionBarController extends Controller
{
    protected function getDomainFromUrl($url)
    {
        $host = parse_url($url, PHP_URL_HOST);
        // Remove 'www.' prefix if present
        return preg_replace('/^www\./', '', strtolower($host));
    }

    protected function getDomainFromOrigin($origin)
    {
        // $origin might be null if header is not set
        if (!$origin) {
            return null;
        }
        $host = parse_url($origin, PHP_URL_HOST);
        return preg_replace('/^www\./', '', strtolower($host));
    }

    protected function ensureOriginMatchesSite(Request $request, $site)
    {
        // Only enforce in production
        if (app()->environment('production')) {
            $origin = $request->headers->get('origin');
            if (!$origin) {
                abort(403, 'Origin header is missing.');
            }
            $siteDomain = $this->getDomainFromUrl($site->url);
            $originDomain = $this->getDomainFromOrigin($origin);

            if (!$originDomain || $originDomain !== $siteDomain) {
                abort(403, 'Origin domain does not match site domain.');
            }
        }
    }

    public function show(Request $request)
    {
        $slug = $request->route('slug');
        $site = Site::where('slug', $slug)->firstOrFail();

        $this->ensureOriginMatchesSite($request, $site);

        return view('embed.bar', [
            'site' => $site,
        ]);
    }

    public function react(Request $request, $slug)
    {
        $reactionTypeId = $request->input('reaction_type_id');
        $reactionType = ReactionType::findOrFail($reactionTypeId);
        $site = Site::where('slug', $slug)->firstOrFail();

        $this->ensureOriginMatchesSite($request, $site);

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
