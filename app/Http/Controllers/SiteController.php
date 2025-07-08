<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Models\Site;
use App\Models\ReactionType;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSiteRequest $request)
    {
        $validated = $request->validated();

        $domain = parse_url($validated['url'], PHP_URL_HOST);
        $siteSlugHash = uniqid($domain);
        $siteAdminHash = uniqid($domain);

        $site = Site::firstOrCreate([
            'url' => $validated['url'],

        ], [
            'slug' => $siteSlugHash,
            'admin_slug' => $siteAdminHash,
        ]);

        $site->reactionTypes()->sync($validated['reaction_types']);

        return view('sites.embed-code', [
            'site' => $site,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site, string $admin_slug)
    {
        if ($site->admin_slug !== $admin_slug) {
            abort(code: 404);
        }

        // Get the last 15 days as labels
        $labels = collect(range(0, 14))->map(function ($i) {
            return now()->subDays(14 - $i)->format('Y-m-d');
        });

        // Get all reaction types for this site
        $reactionTypes = $site->reactionTypes()->get();

        // Get reactions for the last 15 days, grouped by date and reaction_type_id
        $reactions = $site->reactions()
            ->where('created_at', '>=', now()->subDays(14)->startOfDay())
            ->selectRaw('DATE(created_at) as date, reaction_type_id, COUNT(*) as count')
            ->groupBy('date', 'reaction_type_id')
            ->get();

        // Build datasets for Chart.js
        $datasets = $reactionTypes->map(function ($type) use ($labels, $reactions) {
            $countsByDate = $reactions->where('reaction_type_id', $type->id)->keyBy('date');
            $data = $labels->map(function ($date) use ($countsByDate) {
                return (int) optional($countsByDate->get($date))->count;
            });
            return [
                'label' => $type->icon . ' ' . $type->name,
                'backgroundColor' => '#facc15', // yellow-400, you can randomize or use $type->color if available
                'data' => $data,
            ];
        });

        $reactionChartData = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        $allReactionTypes = ReactionType::all();

        return view('sites.show', [
            'site' => $site,
            'reactionChartData' => $reactionChartData,
            'allReactionTypes' => $allReactionTypes,
        ]);
    }

    public function updateReactionTypes(Request $request, Site $site)
    {
        // Only allow if admin_slug matches
        if ($site->admin_slug !== $request->get('admin_slug')) {
            abort(404);
        }
        $site->reactionTypes()->sync($request->input('reaction_types', []));
        $allReactionTypes = ReactionType::all();
        return view('sites.partials.reactiontype-form', [
            'site' => $site,
            'allReactionTypes' => $allReactionTypes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteRequest $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
