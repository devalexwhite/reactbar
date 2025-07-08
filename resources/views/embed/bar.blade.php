<style>
    .embed-bar {
        background: #fff;
        padding: 16px 8px;
        border: 2px solid #222;
        border-radius: 8px;
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 2px 2px 0 #222, 0 0 0 2px #fff inset;
    }

    .reactions-row {
        display: flex;
        gap: 32px;
        justify-content: center;
        width: 100%;
    }

    .reaction-form {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .reaction-button {
        background: #f9f9f9;
        border: 2px solid #222;
        border-radius: 50%;
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        cursor: pointer;
        transition: box-shadow 0.2s, background 0.2s;
        box-shadow: 2px 2px 0 #222, 0 0 0 2px #fff inset;
        position: relative;
    }

    .reaction-button:hover,
    .reaction-button:focus {
        background: #ececec;
        box-shadow: 4px 4px 0 #222, 0 0 0 2px #fff inset;
    }

    .reaction-label {
        margin-top: 8px;
        font-size: 1rem;
        color: #222;
        text-align: center;
        font-weight: 500;
    }

    .reaction-count {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #ffeb3b;
        color: #222;
        border-radius: 50%;
        font-size: 0.85rem;
        padding: 0;
        border: 1.5px solid #222;
        font-weight: bold;
        box-shadow: 1px 1px 0 #222;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 500px) {
        .embed-bar {
            padding: 8px 2px;
            max-width: 98vw;
        }

        .reactions-row {
            gap: 12px;
        }

        .reaction-button {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .reaction-label {
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .reaction-count {
            top: -6px;
            right: -6px;
            font-size: 0.7rem;
            padding: 1px 5px;
        }
    }
</style>

@php
    use App\Models\ReactionType;
    $reactionTypes = ReactionType::all();
    $siteReactionCounts = $site->getReactionCounts();
@endphp

<div id="react-bar-embed">
    <div class="embed-bar">
        <div class="reactions-row">
            @foreach ($reactionTypes as $type)
                @php
                    $count = $siteReactionCounts[$type->id] ?? 0;
                @endphp
                <form onsubmit="window.handleReactBarSubmit(event)"
                    action="{{ route('embed.react', ['slug' => $site->slug]) }}" class="reaction-form">
                    <input type="hidden" name="reaction_type_id" value="{{ $type->id }}">
                    <button type="submit" class="reaction-button" aria-label="{{ $type->name }}">
                        <span class="reaction-icon">{{ $type->icon }}</span>
                        @if($count > 0)
                            <span class="reaction-count">{{ $count }}</span>
                        @endif
                    </button>
                    <span class="reaction-label">{{ $type->name }}</span>
                </form>
            @endforeach
        </div>
    </div>
    <div>
        <p style="text-align: center; font-size: 0.8rem; color: #666;">
            <a href="https://reactbar.thatalexguy.dev" style="color: #007bff; text-decoration: none;" target="_blank">
                Powered by ReactBar
            </a>
        </p>
    </div>
</div>