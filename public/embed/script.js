(function () {
    const loadEmbedBar = async () => {


        // Insert after this script tag
        const currentScript = document.currentScript;

        const slug = currentScript.getAttribute('data-slug');
        const embedBar = document.createElement('div');
        embedBar.id = 'embed-bar';
        embedBar.setAttribute('data-slug', slug);
        embedBar.innerHTML = '<p style="text-align: center;">Loading reactions...</p>';

        if (currentScript && currentScript.parentNode) {
            currentScript.parentNode.insertBefore(embedBar, currentScript.nextSibling);
        }

        try {
            const response = await fetch(`https://reactbar.thatalexguy.dev/embed/${encodeURIComponent(slug)}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const html = await response.text();
            embedBar.innerHTML = html;
        } catch (error) {
            embedBar.innerHTML = '<p>Failed to load embed content.</p>';
        }
    }



    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadEmbedBar);
    } else {
        loadEmbedBar();
    }
})