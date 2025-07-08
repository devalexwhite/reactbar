<x-layout>
    <main class="max-w-5xl mx-auto px-4 py-3 my-16 min-h-screen">
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

            <script src="/embed/script.js" data-slug="reactbar" defer></script>

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

        <section class="mt-16">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-gray-800 text-3xl font-bold mb-4">Got questions?</h3>
                <p class="text-gray-700 mb-4">
                    I've got (some) answers!
                </p>
                <div class="flex flex-col gap-2">
                    <details>
                        <summary>
                            <span class="text-gray-700 text-lg font-medium">Is it really free?</span>
                        </summary>
                        <p class="text-gray-700 mb-4">
                            You know it! There's enough subscription garbage in the world, so I built this as a free
                            tool
                            to support the small web.
                        </p>
                    </details>

                    <details>
                        <summary>
                            <span class="text-gray-700 text-lg font-medium">Do you track anything?</span>
                        </summary>
                        <p class="text-gray-700 mb-4">
                            Nothing identifiable. When someone submits a reaction, the service stores a hash of their IP
                            address,
                            the
                            current date and the reaction ID. This allows the service to prevent someone from spamming
                            the "Like"
                            button. If ReactBar's database was hacked, the hashes would be meaningless. Beyond that, the
                            service
                            does not
                            store
                            any user details.
                        </p>
                    </details>

                    <details>
                        <summary>
                            <span class="text-gray-700 text-lg font-medium">Do I need a seperate embed code for each
                                page?</span>
                        </summary>
                        <p class="text-gray-700 mb-4">
                            At the moment, yes. Each embed code is tied to a specific URL. If you want to collect
                            reactions
                            for multiple pages, you will need to create a new embed code for each page.
                        </p>
                    </details>

                    <details>
                        <summary>
                            <span class="text-gray-700 text-lg font-medium">Why did you build this?</span>
                        </summary>
                        <p class="text-gray-700 mb-4">
                            I wanted to add reactions to my <a href="https://thatalexguy.dev"
                                class="underline text-blue-700" target="_blank">blog</a> in a simple way. So I did what
                            any
                            developer would
                            when faced with a simple task,
                            and built an entire service around it...
                        </p>
                    </details>

                    <details>
                        <summary>
                            <span class="text-gray-700 text-lg font-medium">I wanna chat!</span>
                        </summary>
                        <p class="text-gray-700 mb-4">
                            Awesome! You can email me at <a href="mailto:alex.white@hey.com"
                                class="underline text-blue-700">alex.white@hey.com</a>!
                        </p>
                    </details>
                </div>
            </div>

        </section>
    </main>
    <footer class="text-center text-gray-500 text-sm my-8 ">
        <p>An <a href="https://thatalexguy.dev" class="text-gray-700 hover:underline" target="_blank">Alex White</a>
            Project</p>
        <p class="mt-2">Source code on <a href="https://github.com/devalexwhite/reactbar" target="_blank""
                class=" text-gray-700 hover:underline">GitHub</a></p>
    </footer>
</x-layout>