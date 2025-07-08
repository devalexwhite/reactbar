(function () {
    window.handleReactBarSubmit = async (e) => {
        e.preventDefault();
        const form = e.target.closest('form');
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        if (response.ok) {
            const html = await response.text();
            // Replace the entire embed with the new HTML
            document.getElementById('react-bar-embed').outerHTML = html;
        }
    }


    const loadEmbedBar = async () => {


        // Insert after this script tag
        const currentScript = document.currentScript;

        const slug = currentScript.getAttribute('data-slug');
        const url = currentScript.getAttribute('data-url') || 'https://reactbar.thatalexguy.dev';
        const embedBar = document.createElement('div');
        embedBar.id = 'embed-bar';
        embedBar.setAttribute('data-slug', slug);
        embedBar.innerHTML = '<p style="text-align: center;">Loading reactions...</p>';

        if (currentScript && currentScript.parentNode) {
            currentScript.parentNode.insertBefore(embedBar, currentScript.nextSibling);
        }

        try {
            const response = await fetch(`${url}/embed/${encodeURIComponent(slug)}`);
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
})();