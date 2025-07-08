<form hx-post="{{ route('sites.store') }}" id="site-form" hx-target="this" hx-swap="outerHTML">
    @csrf
    <div>
        <label for="url" class="block text-sm/6 font-medium text-gray-900">URL</label>
        <div class="mt-2">
            <input type="url" name="url" id="url" placeholder="https://"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                placeholder="you@example.com" />
        </div>
    </div>

    <div class="mt-6">
        <p for="url" class="block text-sm/6 font-medium text-gray-900">Which reactions should be available?</p>

        <div class="flex flex-wrap gap-x-6 gap-y-2 flex-row">

            <div class="flex flex-wrap gap-4">
                @foreach (\App\Models\ReactionType::all() as $reactionType)
                    <label class="flex items-center gap-2 bg-white px-3 py-2 rounded shadow-sm border border-gray-200">
                        <input type="checkbox" name="reaction_types[]" value="{{ $reactionType->id }}" checked>
                        <span>{{ $reactionType->icon }} {{ $reactionType->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <button type="submit"
        class="mt-6 rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-yellow-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
        Embed Code</button>
</form>