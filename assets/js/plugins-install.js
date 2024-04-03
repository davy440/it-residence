const PluginsInstall = () => {
    const installerForm = document.querySelector('.itre-support-plugins-form');

    if (!installerForm) {
        return;
    }

    const url = new URL(document.location.href);
    url.searchParams.set("page", "demo-importer");
    
    const process = installerForm.querySelector('.process');
    const plugin = installerForm.querySelector('.plugin');
    const activated = new Event("activated");

    const hideImportSection = function() {
        const noThanks = document.querySelector('.itre-support-plugins__links--nothanks');
        noThanks.addEventListener('click', () => {
            this.remove();
        });
    }

    const importDiv = document.querySelector('.itre-demo-import');

    if (importDiv) {
        hideImportSection.apply(importDiv);
    }

    document.addEventListener('activated', () => {
        const btns = installerForm.querySelectorAll('button');
        if (btns.length === 0) {

            let div = document.createElement('div');
            div.classList.add('itre-demo-import');
            div.innerHTML = '<p>Plugins installed. You are ready to start with your website. Create something awesome!</p>';
            div.innerHTML += '<p>You can also import content from our pre-made demos.</p>';
            div.innerHTML += `<div class="itre-support-plugins__links"><a href="${url}" class="itre-support-plugins__links--demos">Import Demo</a><button class="itre-support-plugins__links--nothanks">No Thanks!</button></div>`;
            installerForm.append(div);

            hideImportSection.apply(div);
        }
    });

    const installPlugin = async (values, btn) => {
        
        const { process, plugin } = values;

        if (!process || !plugin) {
            return;
        }

        const { action, installer_nonce } = data;

        const uri = `action=${action}&process=${process}&plugin=${plugin}&nonce=${installer_nonce}`;

        try {
            const response = await fetch(ajaxurl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: uri
            });

            const result = await response.text();

            if (result !== false && btn.innerHTML.includes('Installing')) {
                btn.innerHTML = 'Activate';
                btn.setAttribute('data-process', 'activate');
            }
            
            if (result === "" && btn.innerHTML.includes('Activating')) {
                const span = document.createElement("span");
                span.classList.add("activated");
                const text = document.createTextNode("Activated");
                span.append(text);
                btn.replaceWith(span);
                document.dispatchEvent(activated);
            }
        } catch {
            console.log(error);
        }
    };

    installerForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const { submitter } = e;
        process.value = submitter.dataset['process'];
        plugin.value = submitter.dataset['slug'];
        
        if (submitter.innerHTML === 'Install') {
            submitter.innerHTML = 'Installing' + '<svg class="loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48.25" height="48.25" viewBox="0 0 48.25 48.25"><defs><clipPath id="a" transform="translate(0.13 0.13)"><rect width="48" height="48" fill="none" stroke="#843a3a" stroke-miterlimit="10" stroke-width="0.25" opacity="0"/></clipPath></defs><title>loader</title><g clip-path="url(#a)"><path d="M14,15.11a13.3,13.3,0,0,1,9.32-4.45L23,5A19.27,19.27,0,0,0,9.74,11.3,18.86,18.86,0,0,0,4.83,24.37l-3.39.24,6.63,5.85,5.85-6.62-3.39.24A13.46,13.46,0,0,1,14,15.11Z" transform="translate(0.13 0.13)" fill="#fff"/><path d="M37.54,34.83,28.89,33l1.8,2.79a13.77,13.77,0,0,1-18-4.36L7.85,34.59A19.13,19.13,0,0,0,22.38,43.2a19.74,19.74,0,0,0,11.45-2.6l1.9,2.87,1.81-8.64Z" transform="translate(0.13 0.13)" fill="#fff"/><path d="M42.39,18.05A19.68,19.68,0,0,0,33.52,7.24L35.1,4.12,26.67,6.81l2.69,8.44,1.5-3a13.63,13.63,0,0,1,6,7.4,13.45,13.45,0,0,1-.79,10.28l5.1,2.65A18.56,18.56,0,0,0,42.39,18.05Z" transform="translate(0.13 0.13)" fill="#fff"/></g><rect x="0.13" y="0.13" width="48" height="48" fill="none" stroke="#843a3a" stroke-miterlimit="10" stroke-width="0.25" opacity="0"/></svg>';
        }

        if (submitter.innerHTML === 'Activate') {
            submitter.innerHTML = 'Activating' + '<svg class="loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48.25" height="48.25" viewBox="0 0 48.25 48.25"><defs><clipPath id="a" transform="translate(0.13 0.13)"><rect width="48" height="48" fill="none" stroke="#843a3a" stroke-miterlimit="10" stroke-width="0.25" opacity="0"/></clipPath></defs><title>loader</title><g clip-path="url(#a)"><path d="M14,15.11a13.3,13.3,0,0,1,9.32-4.45L23,5A19.27,19.27,0,0,0,9.74,11.3,18.86,18.86,0,0,0,4.83,24.37l-3.39.24,6.63,5.85,5.85-6.62-3.39.24A13.46,13.46,0,0,1,14,15.11Z" transform="translate(0.13 0.13)" fill="#fff"/><path d="M37.54,34.83,28.89,33l1.8,2.79a13.77,13.77,0,0,1-18-4.36L7.85,34.59A19.13,19.13,0,0,0,22.38,43.2a19.74,19.74,0,0,0,11.45-2.6l1.9,2.87,1.81-8.64Z" transform="translate(0.13 0.13)" fill="#fff"/><path d="M42.39,18.05A19.68,19.68,0,0,0,33.52,7.24L35.1,4.12,26.67,6.81l2.69,8.44,1.5-3a13.63,13.63,0,0,1,6,7.4,13.45,13.45,0,0,1-.79,10.28l5.1,2.65A18.56,18.56,0,0,0,42.39,18.05Z" transform="translate(0.13 0.13)" fill="#fff"/></g><rect x="0.13" y="0.13" width="48" height="48" fill="none" stroke="#843a3a" stroke-miterlimit="10" stroke-width="0.25" opacity="0"/></svg>';
        }

        const data = new FormData(installerForm);
        const values = {};
        for(const pair of data.entries()) {
            values[pair[0]] = pair[1];
        }
       installPlugin(values, submitter);
    });
}

PluginsInstall();