<x-layout>
    <main class="max-w-5xl mx-auto px-4 py-3 my-16 min-h-screen">
        <header class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="font-bold text-gray-800 leading-14 text-4xl">Site Details</h1>
            <h2 class="mt-4 font-medium text-gray-700 text-xl">Manage your site and view reactions below.</h2>
        </header>

        <section class="bg-yellow-50 px-4 py-8 rounded mb-12">
            <div class="max-w-xl mx-auto">
                <h2 class="text-gray-800 text-2xl font-bold mb-4">{{ $site->name }}</h2>
                <p class="text-gray-700 mb-2"><span class="font-semibold">URL:</span> {{ $site->url ?? 'N/A' }}</p>
                <p class="text-gray-700 mb-2"><span class="font-semibold">Admin Slug:</span> {{ $site->admin_slug }}</p>
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2">Embed Code</h3>
                    <textarea
                        class="bg-gray-200 p-3 rounded text-sm overflow-x-auto select-all w-full">@include('embed.code', ['site' => $site])</textarea>
                </div>
                <div class="mt-8">
                    <div id="reactiontype-form-htmx">
                        @include('sites.partials.reactiontype-form', ['site' => $site, 'allReactionTypes' => $allReactionTypes])
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-16">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-gray-800 text-2xl font-bold mb-4">Sitewide Reactions</h3>
                <p class="text-gray-700 mb-4">
                    All reactions across the site in the last 15 days.
                </p>
                <canvas id="reactionsChart" height="120"></canvas>
                <noscript>
                    <ul class="list-disc pl-5 mt-4">
                        @foreach($site->reactionTypes as $type)
                            <li>{{ $type->name }}: {{ $type->reactions_count }} reactions</li>
                        @endforeach
                    </ul>
                </noscript>
            </div>
        </section>
    </main>
    <footer class="text-center text-gray-500 text-sm my-8 ">
        <p>An <a href="https://thatalexguy.dev" class="text-gray-700 hover:underline" target="_blank">Alex White</a>
            Project</p>
        <p class="mt-2">Source code on <a href="https://github.com/devalexwhite/reactbar" target="_blank"
                class="text-gray-700 hover:underline">GitHub</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($reactionChartData ?? [
            'labels' => [],
            'datasets' => []
        ]);

        // Generate a color palette for each bar
        function generateColors(count) {
            const palette = [
                '#f87171', '#fbbf24', '#34d399', '#60a5fa', '#a78bfa', '#f472b6', '#facc15', '#38bdf8', '#4ade80', '#c084fc'
            ];
            // Repeat palette if not enough colors
            return Array.from({ length: count }, (_, i) => palette[i % palette.length]);
        }

        if (chartData.labels.length && chartData.datasets.length) {
            // Assume only one dataset for bar chart
            let colors = generateColors(chartData.datasets.length);

            chartData.datasets.forEach((dataset, index) => {
                dataset.backgroundColor = colors[index];
            });

            const ctx = document.getElementById('reactionsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: false }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Date' }, stacked: false },
                        y: { title: { display: true, text: 'Reactions' }, beginAtZero: true, stacked: false }
                    }
                }
            });
        }
    </script>
</x-layout>