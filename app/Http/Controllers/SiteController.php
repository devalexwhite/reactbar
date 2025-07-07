<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Models\Site;

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

        return view('sites.embed-code', [
            'site' => $site,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        //
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
