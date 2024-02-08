// JS for Property Filter
(function() {
    const filterDiv = document.querySelector('.itre-property-filter');
    if (!filterDiv) {
        return;
    }
	
    const form = filterDiv.querySelector('form');
    const propertyContainer = document.querySelector('.itre-property-listing');
	
    const { ajaxurl, action_filter, nonce_filter } = filter;

    const filterProperties = async (body) => {
        const response = await fetch(ajaxurl, {
            method: 'POST',
            credrentials: 'same-origin',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body
        });
        const results = await response.text();
        return results;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let requestBody = '';
        const data = new FormData(form);
        for (const pair of data.entries()) {
            if (pair[1] !== "" && pair[1] !== "0") {
                requestBody += `&${pair[0]}=${pair[1]}`;
            }
        }

        if (requestBody === "") {
            return;
        }

		propertyContainer.innerHTML = "";
        const body = `action=${action_filter}&nonce=${nonce_filter}${requestBody}`;
    	const filteredProperties = await filterProperties(body);
		propertyContainer.innerHTML = filteredProperties;
    });
})();