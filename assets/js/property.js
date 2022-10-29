// Frontend JS for IT Listings plugin

jQuery(document).ready(function() {

	var propType, minArea, maxArea, beds, minPrice, maxPrice, filterBtn, filterForm, listingContainer

	listingDiv	= jQuery('.itre-property-listing'),
	filterForm	= jQuery("#itre-property-filter-form"),
	filterBtn 	= jQuery(".filter-btn"),
	propType 	= filterForm.find('#property-type'),
	minArea		= filterForm.find('#min-area'),
	maxArea		= filterForm.find('#max-area'),
	beds		= filterForm.find('#bedrooms'),
	baths		= filterForm.find('#bathrooms'),
	minPrice	= filterForm.find('#min-price'),
	maxPrice	= filterForm.find('#max-price')


	filterBtn.on("click", function() {

		var data = {
			action	: 'itre_ajax_property',
            security: itre.nonce,
			type	: propType.val(),
			minArea	: parseInt(minArea.val()),
			maxArea	: parseInt(maxArea.val()),
			beds	: parseInt(beds.val()),
			minPrice: parseInt(minPrice.val()),
			maxPrice: parseInt(maxPrice.val())
		}

		if ( data.minArea > data.maxArea ) {
			return filterError( minArea, maxArea )
		}

		if ( data.minPrice > data.maxPrice ) {
			return filterError( minPrice, maxPrice )
		}

		filterForm.find('input').css('background-color', 'white');

		jQuery.post(
			itre.ajaxurl,
			data,
			function( response ) {
				listingDiv.html( response )

				if ( response == "" ) {
					listingDiv.html( '<p>Oops, tt seems the property you are looking for is not listed here.</p>' );
				}
			}
		)
	})

	function filterError( field1, field2 ) {
		field1.css('background-color', '#fdd4d4')
		field2.css('background-color', '#fdd4d4')
	}
})
