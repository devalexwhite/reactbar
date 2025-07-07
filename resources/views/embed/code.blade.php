<div id="embed-bar" data-slug="{{ $site->slug }}">
    <p style="text-align: center;">Loading reactions...</p>
</div>

<script defer>
    document.addEventListener('DOMContentLoaded', async () => {
        const embedBar = document.getElementById('embed-bar');
        if (!embedBar) return;

        const slug = embedBar.getAttribute('data-slug');
        if (!slug) return;

        try {
            const response = await fetch(`https://reactbar.thatalexguy.dev/embed/${encodeURIComponent(slug)}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const html = await response.text();
            embedBar.innerHTML = html;
        } catch (error) {
            embedBar.innerHTML = '<p>Failed to load embed content.</p>';
        }
    });
</script>