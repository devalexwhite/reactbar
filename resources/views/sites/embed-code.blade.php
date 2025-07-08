<div>
    <div>
        <label for="admin-url" class="block text-sm/6 font-medium text-gray-900">Save this URL somewhere safe, it's the
            secret admin area for your ReactBar!</label>
        <div class="mt-2">
            <input type="url" name="admin-url" id="admin-url"
                value="{{ route('sites.show', ['site' => $site, 'admin_slug' => $site->admin_slug]) }}"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
    </div>

    <div class="mt-6">
        <label for="embed-code" class="block text-sm/6 font-medium text-gray-900">Paste this embed code into your
            HTML:</label>
        <div class="mt-2">
            <textarea rows="8" name="embed-code" id="embed-code"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">@include('embed.code', ['site' => $site])</textarea>
        </div>
    </div>
    <p class="block text-sm/6 font-medium text-gray-900">
        And that's it!
    </p>

    <button type="button"
        class="mt-4 rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-yellow-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        onclick="copyEmbedCode()">
        Copy Code
    </button>

    <script>
        function copyEmbedCode() {
            const textarea = document.getElementById('embed-code');
            textarea.select();
            textarea.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
        }
    </script>
</div>