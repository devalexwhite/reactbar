<h1>Test bed</h1>

@include('embed.code', [
    'slug' => \App\Models\Site::latest()->first()->slug,
    'site' => \App\Models\Site::latest()->first(),
])