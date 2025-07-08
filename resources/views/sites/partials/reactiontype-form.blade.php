<form id="reactiontype-form" hx-post="{{ route('sites.updateReactionTypes', ['site' => $site->id]) }}" hx-params="*"
    hx-swap="outerHTML" hx-trigger="change from:input" class="space-y-2">
    @csrf
    <input type="hidden" name="admin_slug" value="{{ $site->admin_slug }}">
    <fieldset>
        <legend class="font-semibold text-gray-700 mb-2">Enabled Reaction Types</legend>
        <div class="flex flex-wrap gap-4">
            @foreach($allReactionTypes as $type)
                <label class="flex items-center gap-2 bg-white px-3 py-2 rounded shadow-sm border border-gray-200">
                    <input type="checkbox" name="reaction_types[]" value="{{ $type->id }}"
                        @if($site->reactionTypes->contains($type->id)) checked @endif>
                    <span>{{ $type->icon }} {{ $type->name }}</span>
                </label>
            @endforeach
        </div>
    </fieldset>
</form>