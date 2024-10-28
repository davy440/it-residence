// JS for Property Filter
const propertyFilter = () => {
    const filterDiv = document.querySelector('.itre-property-filter');
    if (!filterDiv) {
        return;
    }
	
    const form = filterDiv.querySelector('form');
    const propertyContainer = document.querySelector('.itre-property-listing');
	
    const { ajaxurl, action_filter, nonce_filter } = filter;

    const filterProperties = async (body) => {
        try {
            const response = await fetch(ajaxurl, {
                method: 'POST',
                credrentials: 'same-origin',
                headers: {
                    'Accept': 'text/html',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body
            });
            const results = await response.text();
            return results;
        } catch(err) {
            console.log(err);
            return 'Oops! Some Error Occured.';
        }
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

        propertyContainer.insertAdjacentHTML('beforebegin', '<div class="spinner"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"><path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" transform="translate(-1 -1)" fill="#2e6d87" opacity="0.25" style="isolation:isolate"/><path d="M12,4a8,8,0,0,1,7.89,6.7A1.52,1.52,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.5-1.5,2.11,2.11,0,0,0,0-.25,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.37,12l.25,0h0a1.52,1.52,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z" transform="translate(-1 -1)" fill="#2e6d87"/></svg></div>');
		propertyContainer.innerHTML = "";
        const body = `action=${action_filter}&nonce=${nonce_filter}${requestBody}`;
    	const filteredProperties = await filterProperties(body);
        propertyContainer.previousElementSibling.remove();
		propertyContainer.innerHTML = filteredProperties;
    });
}
propertyFilter();