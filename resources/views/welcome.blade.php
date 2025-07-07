<x-layout>
    <main class="max-w-5xl mx-auto px-8 py-3 my-16 min-h-screen">
        <header class="text-center max-w-2xl mx-auto">
            <h1 class="font-bold text-gray-800 leading-14 text-5xl">Let people
                <span class="bg-yellow-200 px-3 relative mr-2">
                    <span class="italic">react</span>
                    <span
                        class="absolute -top-5 -right-5 rounded-full bg-yellow-300 flex items-center justify-center size-9 rotate-15 font-black text-xl">♥️</span>
                </span> to your webpage!
            </h1>
            <h2 class="mt-8 font-medium text-gray-700 text-2xl">Private, free & simple. Start collecting reactions in
                minutes.</h2>
        </header>

        <div class="mt-16 mb-8">

            @include('embed.bar', ['site' => \App\Models\Site::where('slug', 'reactbar')->first()])

        </div>

        <div class="mt-16 bg-yellow-100 px-4 py-8">
            <div class="max-w-xl mx-auto">
                <p class="text-gray-700 text-lg font-medium">
                    Interested? Let's do this!
                </p>
                <div class="mt-6">
                    @include('sites.form')
                </div>
            </div>
        </div>
    </main>
    <footer class="text-center text-gray-500 text-sm my-8 ">
        <p>An <a href="https://thatalexguy.dev" class="text-gray-700 hover:underline" target="_blank">Alex White</a>
            Project</p>
        <p class="mt-2">Source code on <a href="https://github.com/devalexwhite/reactbar" target="_blank""
                class=" text-gray-700 hover:underline">GitHub</a></p>
    </footer>
</x-layout>